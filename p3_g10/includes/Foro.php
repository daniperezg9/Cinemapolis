<?php 
namespace cinemapolis;

class Foro{

    private $contacto;
    private $idforo;
    private $descripcion;

    public static function listaForo(){
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        if ($conn->connect_error) {
            die("La conexión ha fallado" . $conn->connect_error);
        }
        $query = "SELECT * FROM lista_foros";
        $result = $conn->query($query);
        $lista = $result;
        $result->free();
        return $lista;
    }

    public static function añadirForo($id_foro, $contacto, $descripcion){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $i= $conn->real_escape_string($id_foro);
        $c= $conn->real_escape_string($contacto);
        $d= $conn->real_escape_string($descripcion);

        $query = "SELECT id_foro FROM lista_foros WHERE id_foro = '$i' AND contacto ='$c' ";
        $result = $conn->query($query);

        if ($result->num_rows == 0){      
            $result->free();  
            $query = "INSERT INTO lista_foros (id_foro, contacto, descripcion) VALUES ('$i', '$c', '$d')";
            //seteamos con lo devuelto por la consulta
            $result = $conn->query($query);
        }

        $conn->close();
        return true;
    }
    

    public static function borraForo($id_foro,$contacto)
    {
        if (!$id_foro || !$contacto) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $i= $conn->real_escape_string($id_foro);
        $c= $conn->real_escape_string($contacto);

        $query = "DELETE FROM foro WHERE id_foro = '$i' AND contacto = '$c' ";
        
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        $query = "DELETE FROM lista_foros WHERE id_foro = '$i' AND contacto = '$c'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public static function mismoForo($i,$c){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM lista_foros lf WHERE lf.contacto = '$c' AND lf.id_foro = '$i'");
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch_assoc();
            if ($fila) {
                $result = new Foro($fila['contacto'], $fila['id_foro'], $fila['descripcion']);
            }
            $rs->free();
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        return $result;
    }

    public static function modificarForo($id_foro, $contacto, $descripcion){
        if (!$contacto || !$id_foro) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $i= $conn->real_escape_string($id_foro);
        $c= $conn->real_escape_string($contacto);
        $d= $conn->real_escape_string($descripcion);

        $query = "UPDATE lista_foros SET descripcion = '$d' WHERE  id_foro = '$i' AND contacto = '$c'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

}


