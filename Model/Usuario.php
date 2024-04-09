<?php
require_once "Conexion.php";
class Usuario{
    private $conn;
    public $id;
    public $nombre;
    public $dni;

    public $vehiculo_id;

    public function __construct(){
        $db = new Conexion();
        $this->conn = $db->getConexion();
    }

    public function listar(){
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function crear($dni,$nombre,$vehiculo_id){
        //Comprobar que no existe un usuario con mismo dni
        $sql = "INSERT INTO usuarios (nombre,dni,vehiculo_id) values('$nombre' ,'$dni',$vehiculo_id)";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
    public function leer($id){
        $sql = "SELECT * FROM usuarios where id=$id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
     
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        return $datos;
    }

    public function eliminar($id){
        if($this->leer($id)){
            $sql = "DELETE FROM usuarios where id = $id";
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute()){
                echo "Eliminado correctamente";
                return true;
            }else{
                echo "No Eliminado";
                return false;
            }
        }else{
            echo "No existe un usuario con id = $id";
            return false;
        }

    }

    public function actualizar($id,$nombre,$dni,$vehiculo_id){
        //Comprobar que existe el usuario antes de actualizar

        $sql = "UPDATE usuarios SET nombre='$nombre',dni='$dni',vehiculo_id=$vehiculo_id where id = $id";
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            echo "Actualizado correctamente";
            return true;
        }else{
            echo "No Actualizado";
            return false;
        }
        
    }
   

}

$dni = "999999Z";
$nombre = "Luis";
$vehiculo_id = 1;
$u = new Usuario();
var_dump($u->leer(1));
?>