<?php 
namespace cinemapolis\src;

class Mensaje{

    private $contacto;
    private $idforo;
    private $mensaje;
    private $fecha_envio;

    public function getIdForo()
    {
        return $this->idforo;
    }

    public function getContacto()
    {
        return $this->contacto;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function getFE()
    {
        return $this->fecha_envio;
    }

    private function __construct($idforo,$contacto,$mensaje, $fecha_envio) {
        $this->idforo = $idforo;
        $this->contacto = $contacto;
        $this->mensaje = $mensaje;
        $this->fecha_envio = $fecha_envio;
    }

    public static function listaMensajes(){
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
          if ($conn->connect_error) {
              die("La conexión ha fallado" . $conn->connect_error);
        }
        $idforo=$conn->real_escape_string($_POST['id_foro']);
        $query = "SELECT f.contacto AS contacto , f.fecha_envio AS fecha_envio ,f.mensaje AS mensaje FROM `foro` f join `lista_foros` lf ON f.id_foro=lf.id_foro WHERE lf.id_foro ='$idforo' ORDER BY f.fecha_envio";
        $rs = $conn->query($query);
        $result = [];
        $i = 0;
        if ($rs) {
            foreach ($rs as $fila) {  
                $result[$i] = new Mensaje($idforo, $fila['contacto'], $fila['mensaje'], $fila['fecha_envio']);
                $i++;
            }
            $rs->free();
        }
        else {
            error_log("Error BD ({$conn->errno}): $conn->error");
        }
        return $result;
    }

    public static function añadirMensaje($id_foro, $contacto, $mensaje, $fecha_envio){
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $i=$conn->real_escape_string($id_foro);
        $c=$conn->real_escape_string($contacto);
        $m=$conn->real_escape_string($mensaje);
        $f=$conn->real_escape_string($fecha_envio);

        $query = "INSERT INTO foro (id_foro, contacto, mensaje, fecha_envio) VALUES ('$i', '$c', '$m', '$f')";
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

        $c=$conn->real_escape_string($contacto);
        $f=$conn->real_escape_string($fecha_envio);

        $query = "DELETE FROM foro WHERE fecha_envio = '$f' AND contacto = '$c'";
        $result = $conn->query($query);

        return true;
    }
    

    public static function modificarMensaje($mensaje, $fecha_envio){
        if (!$mensaje || !$fecha_envio) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $m=$conn->real_escape_string($mensaje);
        $f=$conn->real_escape_string($fecha_envio);

        //¿no falta el contacto ?

        $query = "UPDATE foro SET mensaje = '$m (EDITADO)' WHERE  fecha_envio = '$f'";
        $result = $conn->query($query);

        return true;
    }

}


