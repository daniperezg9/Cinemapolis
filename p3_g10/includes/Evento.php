<?php 
namespace cinemapolis;

class Evento{

    public static function borrarEvento($nombre_evento,$creador_evento,$fecha_evento)
    {
        if (!$nombre_evento || !$creador_evento || !$fecha_evento) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM eventos WHERE nombre_evento = '$nombre_evento' AND creador_evento = '$creador_evento' AND fecha_evento = '$fecha_evento'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

}


