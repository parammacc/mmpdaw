function Usuario(id, nombre, apellidos, fecha, penalizacion) {
    this.id = id || 0;
    this.nombre = nombre || "";
    this.apellidos = apellidos || "";
    if (!fecha)
        this.fecha = new Date("2000-10-26");
    else
        this.fecha = new Date(fecha);
    this.penalizacion = penalizacion || "";
}

function Libro(id, nombre, autor, genero, ejemplares) {
    this.id = id || 0;
    this.nombre = nombre || "";
    this.autor = autor || "";
    this.genero = genero || "";
    this.ejemplares = ejemplares || "";
}

function Prestamos(libro, usuario, entrega, devolucion) {
    this.libro = libro || 0;
    this.usuario = usuario || "";
    if (!entrega)
        this.entrega = new Date("2000-10-26");
    else
        this.entrega = new Date(entrega);
    if (!devolucion)
        this.devolucion = new Date("2000-10-26");
    else
        this.devolucion = new Date(devolucion);
}

var app = angular.module('miAplicacion', ['ngRoute']);

app.config(function($routeProvider) {

    $routeProvider
        .when('/', {
            templateUrl: './listado_Usuarios.html'
        })
        .when('/principal', {
            templateUrl: './listado_Usuarios.html'
        })
        .when('/nuevoUsuario', {
            templateUrl: './gestion_Usuarios.html'
        })
        .when('/libros', {
            templateUrl: './listado_Libros.html'
        })
        .when('/prestamos', {
            templateUrl: './listado_Prestamos.html'
        })
        .when('/nuevoPrestamo', {
            templateUrl: './gestion_Prestamos.html'
        })
        .otherwise({
            redirectTo: '/'
        });
});

function Principal($scope, $http, $location) {

    $scope.nuevo = new Usuario();

    $scope.accion = { id: 2, texto: "Añadir" };

    gestionUsuarios({ accion: 0 });

    function gestionUsuarios(u) {
        console.log(u);
        var envio = $http.post("./conexion.php", u);
        envio.then(function(respuesta) {
            console.log(respuesta);
            $scope.usuarios = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
    }

    $scope.listarLibros = function() {
        var envio = $http.post("./conexion.php", { accion: 4 });
        envio.then(function(respuesta) {
            console.log(respuesta);
            $scope.libros = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
    }

    $scope.listarPrestamos = function() {
        var envio = $http.post("./conexion.php", { accion: 5 });
        envio.then(function(respuesta) {
            console.log(respuesta);
            $scope.prestamos = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });

    }

    $scope.nuevoUsuario = function() {
        $scope.accion.texto = "Añadir";
        var obj = new Usuario($scope.nuevo.id, $scope.nuevo.nombre, $scope.nuevo.apellidos, $scope.nuevo.fecha, $scope.nuevo.penalizacion);
        obj.accion = $scope.accion.id;
        console.log(obj);
        gestionUsuarios(obj);
        $scope.nuevo = new Usuario();
    }

    $scope.borrarUsuario = function() {
        var obj = new Usuario(this.u.id);
        obj.accion = 3;
        if (confirm("Estas seguro/a de querer ELIMINAR a " + this.u.nombre + " " + this.u.apellidos)) {
            gestionUsuarios(obj);
        }
        $scope.accion.id = 0;
    }

    $scope.modificarUsuario = function() {
        $scope.accion.texto = "Modificar";
        $scope.nuevo = new Usuario(this.u.id, this.u.nombre, this.u.apellidos, this.u.fecha, this.u.penalizacion);
        $scope.accion.id = 1;
        $location.path("nuevoUsuario");
    }

    $scope.nuevoPrestamo = function() {
        var obj = new Prestamos($scope.nuevo.libro, $scope.nuevo.usuario);

        var fecha = new Date();
        var dd = fecha.getDate();
        var mm = fecha.getMonth() + 1;
        var yyyy = fecha.getFullYear();

        fecha.setDate(dd, mm, yyyy);
        obj.entrega = fecha;

        var fecha2 = new Date();
        dd = fecha2.getDate() + 15;
        fecha2.setDate(dd, mm, yyyy);

        obj.devolucion = fecha2;
        obj.accion = 6;
        console.log(obj);

        gestionUsuarios(obj);
        $scope.nuevo = new Usuario();
    }

}

app.controller("cuerpo", Principal);