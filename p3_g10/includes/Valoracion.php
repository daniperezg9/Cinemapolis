<?php 
namespace cinemapolis;

class Valoracion{

    public static function borrarValoracion($contacto,$pelicula)
    {
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM valoracion WHERE contacto = '$contacto' AND pelicula = '$pelicula'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public modificarValoraciones($contacto,$pelicula,$valoracion){
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE valoracion SET puntuacion = '$valoracion (EDITADO)' WHERE  contacto = '$contacto' AND pelicula = '$pelicula'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

}

