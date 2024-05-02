<?php 
namespace cinemapolis;

class Evento{

    public static function borrarEvento($nombre_evento,$creador_evento,$fecha_evento){
        if (!$nombre_evento || !$creador_evento || !$fecha_evento) {
            return false;
        } 
    }
    public static function modificarEvento($nombre_evento,$descripcion_evento,$fecha_evento,$nombre_evento_old,$fecha_evento_old,$creador_evento_old, $fecha_actual){
        if (!$nombre_evento || !$descripcion_evento || !$fecha_evento || !$nombre_evento_old || !$fecha_evento_old || !$creador_evento_old || !$fecha_actual) {
            return false;
        }  
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $n=$conn->real_escape_string($nombre_evento);
        $d=$conn->real_escape_string($descripcion_evento);
        $fe=$conn->real_escape_string($fecha_evento);
        $no=$conn->real_escape_string($nombre_evento_old);
        $c=$conn->real_escape_string($creador_evento_old);
        $feo=$conn->real_escape_string($fecha_evento_old);
        $fa=$conn->real_escape_string($fecha_actual);

        $query = "UPDATE eventos SET nombre_evento = '$n (EDITADO)', descripcion_evento='$d (EDITADO)',fecha_evento = '$fe (EDITADO)',fecha_creacion = '$fa (EDITADO)' WHERE creador_evento = '$c' AND nombre_evento ='$no' AND fecha_evento = '$feo'";
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


