<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    //abrimos conexión 
    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if (mysqli_connect_errno()){
        die("error de conexión con BBDD". mysqli_connect_error());
    }

    //quitamos la insercion de codigo html y php
    $fecha_envio=$conn->real_escape_string($_POST['fecha_envio']);
    $contacto = $conn->real_escape_string($_POST['contacto']);

    Mensaje::borraMensaje($contacto, $fecha_envio);
    
    header('Location: ./foro.php');
?>