//import { Usuario } from "Usuario.js";
import Usuario from './Usuario.js';
import Libro from './Libro.js';

//import {obtenerUsuarios} from './Usuarios.js';
//import {gestionLibros} from './Usuarios.js';

//var usu = new Usuario(0,"wanolo");
//console.log(usu);
//alert(usu.id+" "+usu.nombre);

/*
var libro = new Libro(0,"libro gordo de petete");
alert(libro.id+" "+libro.nombre);
*/
var app = angular.module('miAplicacion', ['ngRoute']);

app.config(function($routeProvider){
    $routeProvider
        .when('/', {templateUrl: './error.html'})
        .when('/usuarios', {templateUrl: './usuarios.html'})
        .when('/anadirUsuario', {templateUrl: './anadirUsuario.html'})
        .when('/detallesUsuario', {templateUrl: './detallesUsuario.html'})
        .when('/modificarUsuario', {templateUrl: './modificarUsuario.html'})
        .when('/libros', {templateUrl: './libros.html'})
        .when('/detallesLibro', {templateUrl: './detallesLibro.html'})
        .when('/modificarLibro', {templateUrl: './modificarLibro.html'})
        .when('/anadirLibro', {templateUrl: './anadirLibro.html'})
    //    .otherwise({templateUrl: './error.html'});
        .otherwise({redirectTo: '/'});
});

function Principal($scope, $http, $location){

    $scope.nuevoUsuario = new Usuario();
    $scope.nuevoLibro = new Libro();

    $scope.accion = { id: 3, texto: "Añadir" }; //por defecto añado objeto y el texto es Añadir
//    alert("estoy en principal");
        console.log("estoy en principal");
    /****************************************/
    //  USUARIOS
    /************************************** */
    /*
    $scope.obtenerUsuarios = function() {
        console.log("estoy en obtenerUsuarios");
        var envioObtenerUsuarios = $http.post("http://localhost/sbiblioteca/UsuarioController.php", {accion:0});
        envioObtenerUsuarios.then(function(respuesta) {
            console.log(respuesta.data);
            $scope.usuarios = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
    }
    */
    
    //$scope.obtenerUsuarios = obtenerUsuarios($scope,$http,$location);
    gestionUsuarios({accion:0});
    function gestionUsuarios(usu){
        console.log("estoy en obtenerUsuarios");
    //    $scope.nuevoUsuario = new Usuario();    //esto es para que no mantenga los valores de detalles a nuevo
        var envioObtenerUsuarios = $http.post("http://localhost/sbiblioteca/UsuarioController.php", usu);
        envioObtenerUsuarios.then(function(respuesta) {
            console.log(respuesta.data);
        //    $scope.nuevoUsuario = new Usuario();    //esto es para que no mantenga los valores de detalles a nuevo
            $scope.usuarios = respuesta.data;
        //    $scope.nuevoUsuario = new Usuario();    //esto es para que no mantenga los valores de detalles a nuevo
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
    }

    $scope.detallesUsuario = function(){
        console.log("estoy en detallesUsuario");
        var usu = new Usuario(this.u.id, this.u.nombre);
        console.log(usu);
        console.log(this.u.id+" "+this.u.nombre+" "+this.u.bibliotecario);
    //    alert(usu.id+" "+usu.nombre+" "+usu.bibliotecario);
        $scope.nuevoUsuario = new Usuario(this.u.id, this.u.nombre, this.u.bibliotecario);
    //    $scope.accion.id= 1;
    //    usu.accion = 1
    //    gestionUsuarios(usu);
        $location.path("detallesUsuario");
    //    $scope.nuevoUsuario = new Usuario();  //"resetea" usuario 
        /*
        var envioDetallesUsuario = $http.post("http://localhost/sbiblioteca/UsuarioController.php", {accion:1});
        envioDetallesUsuario.then(function(respuesta) {
            console.log(respuesta.data);
            $scope.usuario = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
        */
    }
    $scope.eliminarUsuario = function(){
        var usu = new Usuario(this.u.id);   //u.id lo recojo en usuarios.html
        console.log("estoy en eliminarUsuario");
        console.log(usu);
        usu.accion = 2; //2 es eliminarUsuario
        if(confirm("¿Eliminar a "+this.u.nombre+"?")){
            gestionUsuarios(usu);
        //    obtenerUsuarios($scope,$http,$location,usu);
        //    $location.path("libros");
        }
        //$location.path("usuarios");
        $scope.accion.id=0; //
    }
    $scope.anadirUsuario = function(){
    //    $scope.action.texto = "Añadir";
        var usu = new Usuario($scope.nuevoUsuario.id,$scope.nuevoUsuario.nombre,$scope.nuevoUsuario.bibliotecario);
        //usu.accion = $scope.accion.id;
        usu.accion=3;   //3 es añadir
        console.log(usu);
    //    alert(usu);
        gestionUsuarios(usu);
    //    $location.path("detallesUsuario");
        $scope.nuevoUsuario = new Usuario();
    //    $location.path("detallesUsuario");
    //    $location.path("anadirUsuarios");
        $location.path("usuarios");
    }
    $scope.modificarUsuario = function(){
    
    //    $scope.accion.texto = "Modificar";
        $scope.nuevoUsuario = new Usuario(this.u.id,this.u.nombre,this.u.bibliotecario);
    //    var usu = $scope.nuevoUsuario;
    //    usu.accion = 4; //4 es modificar
    //    gestionUsuarios(usu);
        $location.path("modificarUsuario")
    //    $scope.accion.id = 4;
    //    $location.path("usuarios");
    }
    $scope.guardarModificacionUsuario = function(){
        console.log("estoy en guardarModificación");
        var usu = new Usuario($scope.nuevoUsuario.id, $scope.nuevoUsuario.nombre, $scope.nuevoUsuario.bibliotecario);
        usu.accion = 4; //4 es modificar
        console.log(usu);
    //    alert(usu.id+" "+usu.nombre+" "+usu.bibliotecario);
        gestionUsuarios(usu);
        $scope.nuevoUsuario = new Usuario();
        $location.path("usuarios");
    }
    $scope.volverUsuarios=function(){
        $scope.nuevoUsuario = new Usuario();
        $location.path("usuarios");
    }
    /************************************* */
    /************************************** */
    //libros
    /*
    $scope.cabeza = function() {
        console.log("estoy en gestionLibros");
        var enviolibros = $http.post("http://localhost/sbiblioteca/LibroController.php", {accion:0});
        enviolibros.then(function(respuesta) {
        //    console.log("estoy en gestionLibros");
            console.log(respuesta.data);
            $scope.libros = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
    }
    */
    gestionLibros({accion:0});
    function gestionLibros(lib){
        console.log("estoy en gestionLibros");
        var envioObtenerLibros = $http.post("http://localhost/sbiblioteca/LibroController.php", lib);
        envioObtenerLibros.then(function(respuesta) {
            console.log(respuesta.data);
            $scope.libros = respuesta.data;
        }, function(respuesta) {
            $scope.respuesta = "Error: " + respuesta + " <br> " + respuesta.statusText;
        });
    }

    $scope.detallesLibro = function(){
        console.log("estoy en detallesLibro");
        var lib = new Libro(this.l.id, this.l.nombre);
        console.log(lib);
        console.log(this.l.id+" "+this.l.nombre+" "+this.l.bibliotecario);
        $scope.nuevoLibro = new Libro(this.l.id, this.l.nombre, this.l.bibliotecario);
        $location.path("detallesLibro");
    }

    $scope.volverLibros=function(){
        $scope.nuevoLibro = new Libro();
        $location.path("libros");
    }

    $scope.eliminarLibro = function(){
        var lib = new Libro(this.l.id);   //l.id lo recojo en libros.html
        console.log("estoy en eliminarLibro");
        console.log(lib);
        lib.accion = 2; //2 es eliminarLibro
        if(confirm("¿Eliminar a "+this.l.nombre+"?")){
            gestionLibros(lib);
        }
    }

    $scope.modificarLibro = function(){
        $scope.nuevoLibro = new Libro(this.l.id,this.l.nombre,this.l.bibliotecario);
        $location.path("modificarLibro")
    }

    $scope.guardarModificacionLibro = function(){
        console.log("estoy en guardarModificación");
        var lib = new Libro($scope.nuevoLibro.id, $scope.nuevoLibro.nombre, $scope.nuevoLibro.bibliotecario);
        lib.accion = 4; //4 es modificar
        console.log(lib);
        gestionLibros(lib);
        $scope.nuevoLibro = new Libro();
        $location.path("libros");
    }

    $scope.anadirLibro = function(){
        var lib = new Libro($scope.nuevoLibro.id,$scope.nuevoLibro.nombre,$scope.nuevoLibro.bibliotecario);
        lib.accion=3;   //3 es añadir
        console.log(lib);
        gestionLibros(lib);
        $scope.nuevoLibro = new Libro();
        $location.path("libros");
    }
    /*************************************** */
    
}

app.controller("cuerpo", Principal);