<?php 
namespace cinemapolis\src;

class Evento{

    private $creador_evento;	
    private $nombre_evento;
    private $descripcion_evento;
    private $fecha_evento;	
    private $fecha_creacion;	

    public function getCE()
    {
        return $this->creador_evento;
    }

    public function getNE()
    {
        return $this->nombre_evento;
    }

    public function getDE()
    {
        return $this->descripcion_evento;
    }

    public function getFE()
    {
        return $this->fecha_evento;
    }

    public function getFC()
    {
        return $this->fecha_creacion;
    }

    private function __construct($creador_evento, $nombre_evento, $descripcion_evento, $fecha_evento, $fecha_creacion) {
        $this->creador_evento = $creador_evento;
        $this->nombre_evento = $nombre_evento;
        $this->descripcion_evento = $descripcion_evento;
        $this->fecha_evento = $fecha_evento;
        $this->fecha_creacion = $fecha_creacion;
    }

    public static function listaEventos(){
        if(isset($_SESSION['login']) && $_SESSION['login']) {
            $app = Aplicacion::getInstance();
            $conn = $app->getConexionBd();
            if ($conn->connect_error) {
                die("La conexión ha fallado" . $conn->connect_error);
            }
            $query = "SELECT * FROM eventos";
            $rs = $conn->query($query);
            $result = [];
            $i = 0;
            if ($rs) {
                foreach ($rs as $fila) {  
                    $result[$i] = new Evento($fila['creador_evento'], $fila['nombre_evento'], $fila['descripcion_evento'], $fila['fecha_evento'] , $fila['fecha_creacion']);
                    $i++;
                }
                $rs->free();
            }
            else {
                error_log("Error BD ({$conn->errno}): $conn->error");
            }
            return $result;
        }

    }

    public static function borrarEvento($nombre_evento,$creador_evento,$fecha_evento){
        if (!$nombre_evento || !$creador_evento || !$fecha_evento) {
            return false;
        } 
        $conn = Aplicacion::getInstance()->getConexionBd();

        $ne= $conn->real_escape_string($nombre_evento);
        $ce= $conn->real_escape_string($creador_evento);
        $fe = $conn->real_escape_string($fecha_evento);

        $query = "DELETE FROM eventos WHERE nombre_evento = '$ne' AND creador_evento = '$ce' AND fecha_evento = '$fe'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function modificarEvento($nombre_evento,$descripcion_evento,$fecha_evento,$nombre_evento_old,$fecha_evento_old,$creador_evento_old){
        if (!$nombre_evento || !$descripcion_evento || !$fecha_evento || !$nombre_evento_old || !$fecha_evento_old || !$creador_evento_old ) {
            return false;
        }  
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $n=$conn->real_escape_string($nombre_evento);
        $d=$conn->real_escape_string($descripcion_evento);
        $fe=$conn->real_escape_string($fecha_evento);
        $no=$conn->real_escape_string($nombre_evento_old);
        $c=$conn->real_escape_string($creador_evento_old);
        $feo=$conn->real_escape_string($fecha_evento_old);

        $query = "UPDATE eventos SET nombre_evento = '$n (EDITADO)', descripcion_evento='$d (EDITADO)',fecha_evento = '$fe (EDITADO)' WHERE creador_evento = '$c' AND nombre_evento ='$no' AND fecha_evento = '$feo'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function añadirEvento($nombre_evento,$descripcion_evento,$fecha_evento,$fecha_actual,$creador_evento){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $n= $conn->real_escape_string($nombre_evento);
        $d= $conn->real_escape_string($descripcion_evento);
        $fe= $conn->real_escape_string($fecha_evento);
        $fa= $conn->real_escape_string($fecha_actual);
        $c= $conn->real_escape_string($creador_evento);


        $query = "SELECT nombre_evento FROM eventos WHERE creador_evento = '$c' AND nombre_evento ='$n' AND fecha_evento = '$fe'";
        $result = $conn->query($query);

        if ($result->num_rows == 0){      
            $result->free();  
            $query = "INSERT INTO eventos (creador_evento, nombre_evento, descripcion_evento, fecha_evento, fecha_creacion) VALUES ('$c', '$n', '$d','$fe','$fa')";
            //seteamos con lo devuelto por la consulta
            $result = $conn->query($query);
        }
        $conn->close();
        return true;
    }
}


