<?php

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once 'Libro.php';

$libro = new Libro();
$datos = file_get_contents('php://input'); 
$objeto=json_decode($datos);

if($objeto != null){
    switch($objeto->accion){
        case 0:
            print json_encode($libro->obtenerLibros());
            break;
        //filtrar por libro
        case 1:
            print json_encode($libro->obtenerLibro($objeto->id));
            break;
        //eliminar libro
        case 2:
            $libro->eliminarLibro($objeto->id);
            print json_encode($libro->obtenerLibros());
            break;
        case 3:
            $libro->registrarLibro($objeto);
            print json_encode($libro->obtenerLibros());
            break;
        case 4:
            $libro->modificarLibro($objeto);
            print json_encode($libro->obtenerLibros());
            break;
    }  
}
?>
