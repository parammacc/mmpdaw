<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');  //  Todo se devolverá en formato JSON.
require_once 'Usuario.php';

$usuario = new Usuario();
$datos = file_get_contents('php://input'); 
$objeto=json_decode($datos);

if($objeto != null) {
    switch($objeto->accion) {
        //obtener todos los usuarios
	case 0:
            print json_encode($usuario->obtenerUsuarios());
            break;
        //filtrar por usuario
        case 1:
            print json_encode($usuario->obtenerUsuario($objeto->id));
            break;
        //eliminar usuario
        case 2:
            $usuario->eliminaUsuario($objeto->id);
            print json_encode($usuario->obtenerUsuarios());
            break;
        //añadir usuario
        case 3:
            $usuario->registrarUsuario($objeto);
        //    print json_encode($usuario->obtenerUsuario($id));
            print json_encode($usuario->obtenerUsuarios());
            break;
        //modificar usuario
        case 4:
            $usuario->modificarUsuario($objeto);
            print json_encode($usuario->obtenerUsuarios());
            break;
    }
}
?>