<?php 
namespace cinemapolis\src;

class Valoracion{
    private $puntuacion;
    private $contacto;

    private function __construct($contacto, $puntuacion) {
        $this->puntuacion = $puntuacion;
        $this->contacto = $contacto;
    }
    public static function ListaValoracion($p){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT contacto, puntuacion FROM valoraciones WHERE pelicula = '$p'";
        $rs = $conn->query($query);
        $result=[];
        $i=0;
        if($rs->num_rows > 0){
            foreach($rs as $row){
                $result[$i]=new Valoracion($row['contacto'], $row['puntuacion']);
                $i++;
            }
            $rs->free();
            return $result;
        }
        return false;

    }
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

        $query = "UPDATE valoraciones SET puntuacion = '$v' WHERE  contacto = '$c' AND pelicula = '$p'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
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
    public  function getMedia(){
        return $this->promedio_valoraciones;
    }
    public static function buscaUsuarioValoracion($titulo,$contacto){
        if (!$titulo || !$contacto) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $t= $conn->real_escape_string($titulo);
        $c= $conn->real_escape_string($contacto);

        $query = "SELECT * FROM valoraciones WHERE pelicula = '$t' AND contacto = '$c'";

        $result = $conn->query($query);

        if ($result->num_rows == 1){
            return $row= $result->fetch_array();
        }
        $result->free();
        return false;
    }
    public function get_puntuacion(){
        return $this->puntuacion;
    }
    public function get_contacto(){
        return $this->contacto;
    }
}


