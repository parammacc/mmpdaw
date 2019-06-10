<?php
//    phpinfo();
    require_once 'Bibliotecario.php';
    $modelo = new Bibliotecario();
    $aux = $modelo->obtenerBibliotecarios();
    $aux1 = $modelo->obtenerBibliotecario(1);
    $aux2 = $modelo->obtenerBibliotecario(2);
    echo"<pre>";
    print_r($aux);
    echo"</pre>";
    echo"<pre>";
    print_r($aux1);
    echo"</pre>";
    echo"<pre>";
    print_r($aux2);
    echo"</pre>";
    //***********************
    require_once 'Usuario.php';
    $modeloUsuario = new Usuario();
    echo"<pre>";
    print_r($modeloUsuario->obtenerUsuarios());
    echo"</pre>";
    echo"<pre>";
    print_r($modeloUsuario->obtenerUsuario(3));
    echo"</pre>";
    echo"<pre>";
    print_r($modeloUsuario->obtenerUsuario(6));
    echo"</pre>";
    /*
    $oUsu = new stdClass();
    $oUsu->nombre="prueba modificación";
    $oUsu->bibliotecario=1;
    //para probar la modificación
    $oUsu->id=7;
    */
//    $modeloUsuario->registrarUsuario($oUsu);  //funciona
    
    //    $modeloUsuario->modificarUsuario($oUsu);  //funciona
    
    //$modeloUsuario->eliminaUsuario(7);    //funciona
    
    echo"<pre>";
    print_r($modeloUsuario->obtenerUsuarios());
    echo"</pre>";
    
    
?>