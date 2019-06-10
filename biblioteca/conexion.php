<?php
header('Content-Type: application/json'); 

$modelo = new Usuario();
$datos = file_get_contents('php://input'); 
$objeto=json_decode($datos);

if($objeto != null) {
    switch($objeto->accion) {	
			case 0: 
				print json_encode($modelo->Usuarios());
				break;
			
			case 1: 
				$modelo->Actualizar($objeto);
				print json_encode($modelo->Usuarios());
				break;

			case 2: 
				$modelo->Registrar($objeto);
				print json_encode($modelo->Usuarios());
				break;
				
			case 3:  
				$modelo->Eliminar($objeto->id);
				print json_encode($modelo->Usuarios());
                break;                
            case 4:  
                print json_encode($modelo->Libros());
                break; 
            case 5:  
                print json_encode($modelo->Prestamos());
                break;
            case 6:  
                $modelo->RegistrarPrestamo($objeto);
                print json_encode($modelo->Usuarios());
                break;
    }
}

class Usuario {
    private $pdo;

    public function __CONSTRUCT() {
        try {
                $this->pdo = new PDO('mysql:host=localhost;dbname=biblioteca', 'root', '');
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);                
        } catch(Exception $e) {
                die($e->getMessage());
        }
    }

    public function Usuarios() {
        try {
            $sc = "Select * From usuarios";
            $stm = $this->pdo->prepare($sc);
            $stm->execute();
            return ($stm->fetchAll(PDO::FETCH_ASSOC));
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Libros() {
        try {
            $sc = "Select * From libros";
            $stm = $this->pdo->prepare($sc);
            $stm->execute();
            return ($stm->fetchAll(PDO::FETCH_ASSOC));
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Prestamos() {
        try {
            $sc = "Select b.nombre as usuario, b.apellidos, c.nombre as libro, a.entrega, a.devolucion From prestamos a Inner Join usuarios b On(a.usuario = b.id) Inner Join libros c On(a.libro = c.id)";
            $stm = $this->pdo->prepare($sc);
            $stm->execute();
            return ($stm->fetchAll(PDO::FETCH_ASSOC));
        } catch(Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id) {
        try {
            $stm = $this->pdo
            ->prepare("DELETE FROM usuarios WHERE id = ?");                      
            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar($data) {
        try {
            $sql = "UPDATE usuarios SET 
                                    nombre        = ?, 
                                    apellidos     = ?, 
                                    fecha         = ?,
                                    penalizacion  = ?
                            WHERE id = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                    array(
                            $data->nombre, 
                            $data->apellidos, 
                            $data->fecha,
                            $data->penalizacion,
                            $data->id
                            ) 
                    );
        } catch (Exception $e) {
                die($e->getMessage());
        }
    }

    public function Registrar($data) {
            try {
            $sql = "INSERT INTO usuarios (nombre,apellidos,fecha,penalizacion) 
                            VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                    array(
                            $data->nombre, 
                            $data->apellidos, 
                            $data->fecha,
                            $data->penalizacion							
                            )
                    );
            } catch (Exception $e) {
                    die($e->getMessage());
            }
    }

    public function RegistrarPrestamo($data) {
        try {
        $sql = "INSERT INTO prestamos (libro,usuario,entrega,devolucion) 
                        VALUES (?, ?, ?, ?)";

        $this->pdo->prepare($sql)
                ->execute(
                array(
                        $data->libro, 
                        $data->usuario, 
                        $data->entrega,
                        $data->devolucion							
                        )
                );
        } catch (Exception $e) {
                die($e->getMessage());
        }
    }

}


?>