<?php 
namespace cinemapolis;

class Pelicula{

    private $titulo;
    private $sinopsis;
    private $foto;

    public static function borrarPelicula($titulo)
    {
        if (!$titulo) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM peliculas WHERE titulo = '$titulo'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        $query = "DELETE FROM genero_peliculas WHERE titulo = '$titulo'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }
}


