<?php
/**
 * Description of Usuario
 *
 * @author mm
 */
require_once 'MiConexion2.php';

class Usuario {
    //atributos
//    private $conexion;
    private $usuario;
    //constructor
    public function __construct(){
        try{
            $this->usuario = (new MiConexion2())->conexion2();
    //        $this->conexion = new MiConexion();
    //        $opciones = [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"];
    //        $this->usuario = new PDO('mysql:host='.$this->conexion->getServidor().';dbname='.$this->conexion->getBd(), $this->conexion->getUsuario(), $this->conexion->getPwd(), $opciones);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerUsuarios(){
        try{
            $usuarios = $this->usuario->prepare("select * from usuario");
            $usuarios->execute();
            return $usuarios->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function obtenerUsuario($id){
        try{
            $usuario = $this->usuario->prepare("select * from usuario where id = ?");
            $usuario->execute([$id]);
            return $usuario->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function registrarUsuario($oUsuario){
        try{
            $sql = "insert into usuario(nombre,bibliotecario) values(?,?)";
            $this->usuario->prepare($sql)->execute([$oUsuario->nombre, $oUsuario->bibliotecario]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function modificarUsuario($oUsuario){
        try{
            $sql = "update usuario set nombre=?, bibliotecario=? where id=?";
            $this->usuario->prepare($sql)->execute([
                $oUsuario->nombre,
                $oUsuario->bibliotecario,
                $oUsuario->id
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    //
    public function eliminaUsuario($id){
        try{
            $sql = "delete from usuario where id = ?";
            $this->usuario->prepare($sql)->execute([$id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
