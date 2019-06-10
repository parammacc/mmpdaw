<?php
/**
 * Description of Libro
 *
 * @author mm
 */
//require_once 'MiConexion.php';
require_once 'MiConexion2.php';

class Libro{
    //atributos
//    private $conexion;
    private $libro;
    //constructor
    public function __construct(){
        try{
            //versión static
        //    $this->libro = MiConexion2::conexion();
        //    //versión OO
            
            $this->libro = (new MiConexion2())->conexion2();

        //  NO HACERLO DE ESTA MANERA.
        //    $this->conexion = new MiConexion();
        //    $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
        //    $this->libro = new PDO('mysql:host='.$this->conexion->getServidor().';dbname='.$this->conexion->getBd(), $this->conexion->getUsuario(), $this->conexion->getPwd(), $opciones);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerLibros(){
        try{
            $libros = $this->libro->prepare("select * from libro");
            $libros->execute();
            return $libros->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerLibro($id){
        try{
            $libro = $this->libro->prepare("select * from libro where id = ?");
            $libro->execute([$id]);
            return $libro->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function modificarLibro($oLibro){
        try{
            $sql = "update libro set nombre=?, bibliotecario=? where id=?";
            $this->libro->prepare($sql)->execute([
                $oLibro->nombre,
                $oLibro->bibliotecario,
                $oLibro->id
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function eliminarLibro($id){
        try{
            $sql = "delete from libro where id = ?";
            $this->libro->prepare($sql)->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    /*
    public function registrarLibro($oLibro){
        try{
            //
            if($this->obtenerLibro($oLibro->id)==NULL){
                return -1;
            }
            else{
            //    return 0;
                $sql = "insert into libro(nombre,bibliotecario) values(?,?)";
            $this->libro->prepare($sql)->execute([$oLibro->nombre, $oLibro->bibliotecario]);
            }
            //
        //    $sql = "insert into libro(nombre,bibliotecario) values(?,?)";
        //    $this->libro->prepare($sql)->execute([$oLibro->nombre, $oLibro->bibliotecario]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
     */
    
    public function registrarLibro($oLibro){
        try{
            $sql = "insert into libro(nombre,bibliotecario) values(?,?)";
            $this->libro->prepare($sql)->execute([$oLibro->nombre, $oLibro->bibliotecario]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
