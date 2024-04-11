<?php 
namespace cinemapolis;

class Mensaje{

    private $contacto;
    private $idforo;
    private $mensaje;
    private $fecha_envio;

    public static function añadirMensaje($id_foro, $contacto, $mensaje, $fecha_envio){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $query = "INSERT INTO foro (id_foro, contacto, mensaje, fecha_envio) VALUES ('$id_foro', '$contacto', '$mensaje', '$fecha_envio')";
        $result = $conn->query($query);

        $conn->close();
        return true;
    }
    

    public static function borraMensaje($contacto,$fecha_envio) //Borrar por fecha de envio y usuario del mensaje por si dos usuarios mandan a la misma fecha de envio no borre mensajes que no queremos
    {
        if (!$fecha_envio || !$contacto) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM foro WHERE fecha_envio = '$fecha_envio' AND contacto = '$contacto'";
        $result = $conn->query($query);

        return true;
    }
    

    public static function modificarMensaje($mensaje, $fecha_envio){
        if (!$mensaje || !$fecha_envio) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $query = "UPDATE foro SET mensaje = '$mensaje (EDITADO)' WHERE  fecha_envio = '$fecha_envio'";
        $result = $conn->query($query);

        return true;
    }

}


