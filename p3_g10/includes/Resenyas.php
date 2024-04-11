<?php 
namespace cinemapolis;

class Resenyas{

    public static function borrarResenya($contacto,$pelicula)
    {
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM resenyas WHERE contacto = '$contacto' AND pelicula = '$pelicula'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }
    public function modificarResenyas($contacto,$pelicula,$resenya){
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE resenyas SET mensaje = '$resenya (EDITADO)' WHERE  contacto = '$contacto' AND pelicula = '$pelicula'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function mostrarResenyas($pelicula){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT contacto, mensaje FROM resenyas WHERE pelicula = '$pelicula'";
        $result = $conn->query($query);
        if ( !$result ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        while($row = $result->fetch_assoc()){
            echo '<p><strong>' . $row['contacto'] . ':</strong> ' . $row['mensaje'] . '</p>';
            if(Admin::esAdmin($_SESSION)){
                echo '<p><a href="borrarResenya.php?contacto=' . $row['contacto'] . '&pelicula=' . $pelicula . '">Borrar Reseña</a></p>';
            }
        }
        return true;
    }


}


