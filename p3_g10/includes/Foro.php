<?php 
namespace cinemapolis;

class Foro{

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
    public modificarDescripcionForo($id_foro, $contacto, $descripcion){
        if (!$contacto || !$id_foro) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE foro SET descripcion = '$descripcion (EDITADO)' WHERE  id_foro = '$id_foro' AND contacto = '$contacto'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        $query = "UPDATE lista_foros SET descripcion = '$descripcion (EDITADO)' WHERE  id_foro = '$id_foro' AND contacto = '$contacto'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public modificarNombreForo($id_foro, $contacto, $nombre){
        if (!$contacto || !$id_foro) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "UPDATE foro SET id_foro = '$nombre (EDITADO)' WHERE  id_foro = '$id_foro' AND contacto = '$contacto'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }

        $query = "UPDATE lista_foros SET id_foro = '$nombre (EDITADO)' WHERE  id_foro = '$id_foro' AND contacto = '$contacto'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

   

}


