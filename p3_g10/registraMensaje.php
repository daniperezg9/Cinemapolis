<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    //abrimos conexión 
    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if (mysqli_connect_errno()){
        die("error de conexión con BBDD". mysqli_connect_error());
    }

    //quitamos la insercion de codigo html y php
    $fecha_envio=date("Y-m-d H:i:s");
    $contacto =$conn->real_escape_string($_SESSION['contacto']) ;
    $id_foro=$conn->real_escape_string($_POST['id_foro']) ;
    $mensaje=$conn->real_escape_string($_POST['mensaje']) ;

    Mensaje::añadirMensaje($id_foro, $contacto, $mensaje, $fecha_envio);
    
    header('Location: ./foro.php');
?>