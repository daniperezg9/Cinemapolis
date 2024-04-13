<?php 
namespace cinemapolis;

class Evento{

    public static function borrarEvento($nombre_evento,$creador_evento,$fecha_evento)
    {
        if (!$nombre_evento || !$creador_evento || !$fecha_evento) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

       $n = $conn->real_escape_string($nombre) ;
       $c = $conn->real_escape_string($creador_evento);
       $f = $conn->real_escape_string($fecha_evento);

        $query = "DELETE FROM eventos WHERE nombre_evento = '$n' AND creador_evento = '$c' AND fecha_evento = '$f'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

}


