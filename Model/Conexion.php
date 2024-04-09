<?php

class Conexion{

    private $host = "localhost";
    private $db_name = "vehiculos_usuarios_bd";
    private $user = "root";
    private $password = "";
    public $conn;

    public function getConexion(){

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
           
        }catch(PDOException $e){
            echo "Error de conexion: " . $e->getMessage();
        }
        return $this->conn;
      
    }

}

?>
