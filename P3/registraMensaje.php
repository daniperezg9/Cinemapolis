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
    $id_foro=$conn->real_escape_string($_SESSION['id_foro']) ;
    $mensaje=$conn->real_escape_string($_POST['mensaje']) ;

    $query = "INSERT INTO foro (id_foro, contacto, mensaje, fecha_envio) VALUES ('$id_foro', '$contacto', '$mensaje', '$fecha_envio')";
    $result = $conn->query($query);

    $conn->close();
    header('Location: ./foro.php');
?>