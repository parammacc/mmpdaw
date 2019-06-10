<?php
/**
 * Description of MiConexion2
 *
 * @author mm
 */
class MiConexion2 {
    //
    private $conn = null;
    //
    
    public static function conexion(){ 
        try{
            $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $this->conn=new PDO('mysql:host=localhost;dbname=mmbbtk','root','',$opciones);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $this->conn;
    }
    //
    public function conexion2(){
        try{
            $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $this->conn=new PDO('mysql:host=localhost;dbname=mmbbtk','root','',$opciones);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die($e->getMessage());
        }
        return $this->conn;
    }
    
}
