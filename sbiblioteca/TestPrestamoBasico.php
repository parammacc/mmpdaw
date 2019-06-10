<?php

require_once 'PrestamoBasico.php';

$modeloPrestamoBasico = new PrestamoBasico();

echo "<pre>";
print_r($modeloPrestamoBasico->obtenerPrestamos());
echo "</pre>";

echo "<pre>";
print_r($modeloPrestamoBasico->obtenerPrestamo(7));
echo "</pre>";

echo "<pre>";
print_r($modeloPrestamoBasico->obtenerPrestamosUsuario(3));
echo "</pre>";