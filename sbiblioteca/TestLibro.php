<?php

require_once 'Libro.php';

$auxlibro = new Libro();

echo "<pre>";
print_r($auxlibro->obtenerLibros());
echo "</pre>";
die();
echo "<pre>";
print_r($auxlibro->obtenerLibro(16));
echo "</pre>";

$oLibro = new stdClass();

//$oLibro->id=0;    //para añadir libro no hace falta $oLibro->id=0;
$oLibro->id=18; //hace falta para modificar
$oLibro->nombre="pruebo modificarLibro";
$oLibro->bibliotecario=2;
echo "<pre>";
print_r($auxlibro->registrarLibro($oLibro));
echo "</pre>";

//$auxlibro->modificarLibro($oLibro);   //funciona
//$auxlibro->registrarLibro($oLibro);   //funciona
//$auxlibro->eliminarLibro(19);     //funciona