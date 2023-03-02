<?php
// conectar al a BBDD de mYSQL


define('HOST','127.0.0.1');
define('USER', 'root');
define('PASS', '');
define('DB', 'tablaphp');

class DAO{

    private $conexion;
    private $error;

    public function __construct(){
        $this->conexion = new mysqli(HOST, USER, PASS, DB);
        if($this->conexion->connect_errno){
        // error de conexión
            die('Error de conexion : '.$this->conexion->connect_error);
        } 

        $this->error = "";

    }

    public function consultar($SQL){
        $res = $this->conexion->query($SQL,MYSQLI_USE_RESULT);
        $filas = array();

        if($this->conexion->connect_errno){
            // error de conexión
                die('Error en consultar : '.$this->conexion->connect_error);
        }else{
            while($reg = $res->fetch_assoc()){
                $filas[] = $reg;
            }
        }
    
        return $filas;

    }

    public function insertar($SQL){
        $this->conexion->query($SQL,MYSQLI_USE_RESULT);
        if($this->conexion->connect_errno){
            die('Error de consultar: '.$SQL);
            return '';
        }else{
            return $this->conexion->insert_id;
        }
    }
    public function actualizar($SQL){
        $this->conexion->query($SQL,MYSQLI_USE_RESULT);
        if($this->conexion->connect_errno){
            die('Error de consultar: '.$SQL);
        }else{
            return $this->conexion->affected_rows;
            
        }
    }

}
?>
