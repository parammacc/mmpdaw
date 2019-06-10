<?php
/**
 * Description of Bibliotecario
 *
 * @author mm
 */
require_once 'MiConexion.php';

class Bibliotecario{
    //atributos
    private $conexion;
    private $bibliotecario;
    //constructor
    public function __construct() {
        try{
            $this->conexion = new MiConexion();
            $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
            $this->bibliotecario = new PDO('mysql:host='.$this->conexion->getServidor().';dbname='.$this->conexion->getBd(), $this->conexion->getUsuario(), $this->conexion->getPwd(), $opciones);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerBibliotecarios(){
        try{           
            $bibliotecarios = $this->bibliotecario->prepare("select * from bibliotecario");
            $bibliotecarios->execute();
            return $bibliotecarios->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        } //finally{
          //  $this->bibliotecario = null;
        //}
        //return $bibliotecarios->fetchAll(PDO::FETCH_ASSOC);
    }
    //
    public function obtenerBibliotecario($id){
        try{
            $b = $this->bibliotecario->prepare("select * from bibliotecario where id = ?");
            $b->execute([$id]);
            return $b->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
