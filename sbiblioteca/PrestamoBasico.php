<?php
/**
 * Description of PrestamoBasico
 *
 * @author mm
 */
require_once 'MiConexion2.php';

class PrestamoBasico {
    //atributos
    private $prestbasico;
    //constructor
    public function __construct(){
        try{
            $this->prestbasico = (new MiConexion2())->conexion2();      
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerPrestamos(){
        try{
            $prestamos = $this->prestbasico->prepare("select * from prestamo");
            $prestamos->execute();
            return $prestamos->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerPrestamo($id){
        try{
            $prestamo = $this->prestbasico->prepare("select * from prestamo where id = ?");
            $prestamo->execute([$id]);
            return $prestamo->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerPrestamosUsuario($id){
        try{
            $sql="select l.nombre as 'libro' from prestamo as p join libro as l on p.libro=l.id where p.usuario=?";
        //    $librosUsuario = $this->prestbasico->prepare($sql)->execute([$id]);
            $librosUsuario = $this->prestbasico->prepare($sql);
            $librosUsuario->execute([$id]);
            return $librosUsuario->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
