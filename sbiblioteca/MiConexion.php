<?php


/**
 * Description of MiConexion
 *
 * @author mm
 */
class MiConexion{
    //atributos
    private $servidor;
    private $bd;
    private $usuario;
    private $pwd;
    //constructor
    public function __construct(){
        $this->servidor = "localhost";
        $this->bd = "mmbbtk";
        $this->usuario = "root";
        $this->pwd = "";
    }
    
    function getServidor() {
        return $this->servidor;
    }

    function getBd() {
        return $this->bd;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getPwd() {
        return $this->pwd;
    }

        
    /*
    public function __construct(){
        try{
            $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $this->pdo = new PDO('mysql:host=localhost;dbname=mmbbtk','root','',$opciones);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
    }
    */
    //public static function servidor(){
    //    return "localhost";
    //}
    
    //$servidor = "localhost";
    
    /*
    //como función estática
    public static function conexion(){
        try{
            $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $conn = new PDO('mysql:host=localhost;dbname=mmbbtk','root','',$opciones);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //    $conn->exec("set character set utf8");
        } catch (Exception $e) {
        //    die($e->getLine());
            die($e->getMessage());
        } //finally{
          //  $conn = null;
       // }
    }
     
     */
}




/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexion
 *
 * @author mm
 */
/*
class MiConexion {
    //atributos
    private $pdo;
    //como objeto
    /*
    public function __construct() {
        try{
            $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $this->pdo = new PDO('mysql:host=localhost;dbname=mmbbtk','root','',$opciones);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
        //    die($e->getLine());
            die($e->getMessage());
        } 
    }
     
    
    
        
}
*/
?>