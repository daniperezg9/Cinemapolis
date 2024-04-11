<?php 
namespace cinemapolis;

class Foro{

    private $contacto;
    private $idforo;
    private $descripcion;

    public static function añadirForo($id_foro, $contacto, $descripcion){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $query = "SELECT id_foro FROM lista_foros WHERE id_foro = '$id_foro' AND contacto ='$contacto' ";
        $result = $conn->query($query);

        if ($result->num_rows == 0){      
            $result->free();  
            $query = "INSERT INTO lista_foros (contacto, id_foro, descripcion) VALUES ('$contacto', '$id_foro', '$descripcion')";
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
        $query = "DELETE FROM foro WHERE id_foro = '$id_foro' AND contacto = '$contacto' ";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        $query = "DELETE FROM lista_foros WHERE id_foro = '$id_foro' AND contacto = '$contacto'";
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

        $query = "UPDATE lista_foros SET descripcion = '$descripcion' WHERE  id_foro = '$id_foro' AND contacto = '$contacto'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

}


