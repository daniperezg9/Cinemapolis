<?php 
namespace cinemapolis\src;

class Resenyas{
    private $mensaje;
    private $contacto;

    private function __construct($contacto,$mensaje) {
        $this->mensaje = $mensaje;
        $this->contacto = $contacto;
    }

    public static function borrarResenya($contacto,$pelicula)
    {
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $c=$conn->real_escape_string($contacto);
        $p=$conn->real_escape_string($pelicula);


        $query = "DELETE FROM resenyas WHERE contacto = '$c' AND pelicula = '$p'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        unset($_SESSION['reseñas_realizadas'][$pelicula]);
        unset($_SESSION['reseñas_realizadas'][$pelicula][$contacto]);
        return true;
    }
    public static function modificarResenyas($contacto,$pelicula,$resenya){
        if (!$contacto || !$pelicula) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $c=$conn->real_escape_string($contacto);
        $p=$conn->real_escape_string($pelicula);
        $r=$conn->real_escape_string($resenya);

        $query = "UPDATE resenyas SET mensaje = '$r (EDITADO)' WHERE  contacto = '$c' AND pelicula = '$p'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function ListaResenyas($p){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT contacto, mensaje FROM resenyas WHERE pelicula = '$p'";
        $rs = $conn->query($query);
        $result=[];
        $i=0;
        if($rs->num_rows > 0){
            foreach($rs as $row){
                $result[$i]=new Resenyas($row['contacto'], $row['mensaje']);
                $i++;
            }
            $rs->free();
            return $result;
        }
        return false;

    }

    public static function añadirResenya($pelicula,$contacto,$resenya){

        $conn = Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        
        $query = "SELECT * FROM resenyas WHERE contacto = '$contacto' AND pelicula='$pelicula'";

        $c=$conn->real_escape_string($contacto);
        $p=$conn->real_escape_string($pelicula);
        $r=$conn->real_escape_string($resenya);

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
    public static function buscaUsuarioRensenya($titulo,$contacto){
        if (!$titulo || !$contacto) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $t= $conn->real_escape_string($titulo);
        $c= $conn->real_escape_string($contacto);

        $query = "SELECT * FROM resenyas WHERE pelicula = '$t' AND contacto = '$c'";

        $result = $conn->query($query);

        if ($result->num_rows == 1){
            return $row= $result->fetch_array();
        }
        $result->free();
        return false;
    }
    
    public function get_msg(){
        return $this->mensaje;
    }
    public function get_contacto(){
        return $this->contacto;
    }
}


