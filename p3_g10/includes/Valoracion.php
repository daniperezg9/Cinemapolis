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

        $c=$conn->real_escape_string($contacto);
        $p=$conn->real_escape_string($pelicula);

        $query = "DELETE FROM valoraciones WHERE contacto = '$c' AND pelicula = '$p'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function modificarValoraciones($contacto,$pelicula,$valoracion){
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $c=$conn->real_escape_string($contacto);
        $p=$conn->real_escape_string($pelicula);
        $v=$conn->real_escape_string($valoracion);

        $query = "UPDATE valoraciones SET puntuacion = '$v (EDITADO)' WHERE  contacto = '$c' AND pelicula = '$p'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }
    public static function ListaValoracion($p){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT contacto, puntuacion FROM valoraciones WHERE pelicula = '$p'";
        $result = $conn->query($query);
        return $result;

    }

    public static function mostrarValoracion($pelicula){
        $conn = Aplicacion::getInstance()->getConexionBd();

        $p=$conn->real_escape_string($pelicula);


        $query = "SELECT contacto, puntuacion FROM valoraciones WHERE pelicula = '$p'";
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
        
        $c=$conn->real_escape_string($contacto);
        $p=$conn->real_escape_string($pelicula);
        $punt=$conn->real_escape_string($puntuacion);

        $query = "SELECT * FROM valoraciones WHERE contacto = '$c' AND pelicula='$p'";

        $result = $conn->query($query);
        if ($result->num_rows == 0){
            $result -> free();
            $query = "INSERT INTO valoraciones (contacto, pelicula, puntuacion) VALUES ('$c', '$p', '$punt')";
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


