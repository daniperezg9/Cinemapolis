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
                echo '<form action="borrarResenya.php" method="post" style="display: inline;">
                        <input type="hidden" name="contacto" value="' . $row['contacto'] . '">
                        <input type="hidden" name="pelicula" value="' . $pelicula . '">
                        <button type="submit"> Borrar Reseña </button>
                      </form>';
            }
        }
        if($result->num_rows==0){
            echo "<p>No hay reseñas para esta película.</p>";        
        }
        return true;
    }

    public static function añadirResenya($pelicula,$contacto,$resenya){

        $conn = Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        
        $query = "SELECT * FROM resenyas WHERE contacto = '$contacto' AND pelicula='$pelicula'";

        $result = $conn->query($query);
        if ($result->num_rows == 0){
            $result -> free();
            $query = "INSERT INTO resenyas (contacto, pelicula, mensaje) VALUES ('$contacto', '$pelicula', '$resenya')";
            $result = $conn->query($query);
        }else{
            die("Este usuario ya ha realizado una reseña");
        }
        $conn->close();
        return true;
    }


}


