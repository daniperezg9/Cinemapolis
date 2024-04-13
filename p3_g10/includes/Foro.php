<?php 
namespace cinemapolis;

class Foro{

    private $contacto;
    private $idforo;
    private $descripcion;

    public static function añadirForo($id_foro, $contacto, $descripcion){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $i= $conn->real_escape_string($id_foro);
        $c= $conn->real_escape_string($contacto);
        $d= $conn->real_escape_string($descripcion);

        $query = "SELECT id_foro FROM lista_foros WHERE id_foro = '$i' AND contacto ='$c' ";
        $result = $conn->query($query);

        if ($result->num_rows == 0){      
            $result->free();  
            $query = "INSERT INTO lista_foros (contacto, id_foro, descripcion) VALUES ('$c', '$i', '$d')";
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


