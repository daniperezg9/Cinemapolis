<?php 
namespace cinemapolis;

class Valoracion{
    private $promedio_valoraciones;
    public static function borrarValoracion($contacto,$pelicula)
    {
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM valoraciones WHERE contacto = '$contacto' AND pelicula = '$pelicula'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public function modificarValoraciones($contacto,$pelicula,$valoracion){
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

    public static function mostrarValoracion($pelicula){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT contacto, puntuacion FROM valoraciones WHERE pelicula = '$pelicula'";
        $result = $conn->query($query);
        if ( !$result ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
            $total_valoraciones = 0;
            $num_valoraciones = $result->num_rows;
            
        while($row = $result->fetch_assoc()){
            $total_valoraciones += $row['puntuacion'];
            echo '<p><strong>' . $row['contacto'] . ':</strong> ' . $row['puntuacion'] . '</p>';
            if(Admin::esAdmin($_SESSION)){
                echo '<form action="borrarValoraciones.php" method="post" style="display: inline;">
                        <input type="hidden" name="contacto" value="' . $row['contacto'] . '">
                        <input type="hidden" name="pelicula" value="' . $pelicula . '">
                        <button type="submit"> Borrar valoración </button>
                      </form>';
            }
        }
        if ($num_valoraciones > 0) {
            $promedio_valoraciones = $total_valoraciones / $num_valoraciones;
            echo "<p><strong>Puntuación promedio:</strong> " . number_format($promedio_valoraciones, 2) . "</p>";
        } else {
            echo "<p>No hay valoraciones para esta película.</p>";
        }
        return true;
    }
    public static function añadirValoracion($pelicula,$contacto,$puntuacion){

        $conn = Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        
        $query = "SELECT * FROM valoraciones WHERE contacto = '$contacto' AND pelicula='$pelicula'";

        $result = $conn->query($query);
        if ($result->num_rows == 0){
            $result -> free();
            $query = "INSERT INTO valoraciones (contacto, pelicula, puntuacion) VALUES ('$contacto', '$pelicula', '$puntuacion')";
            $result = $conn->query($query);
        }else{
            die("Este usuario ya ha establecido una puntuacion");
        }
        $conn->close();
        return true;
    }
    public function __construct() {
    }
    public  function getMedia(){
        return $this->promedio_valoraciones;
    }
}


