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
    $fecha_envio=$conn->real_escape_string($_GET['fecha_envio']) ;


    $query = "DELETE FROM foro WHERE fecha_envio = '$fecha_envio'"; //Borra unicamente el mensaje creado a una determinada hora (iba a hacerlo para una determinada hora y que solo pudiese borrarlo el que ha creado el mensaje pero entonces el admin no podría borrarlo)
    $result = $conn->query($query);
    
    header('Location: ./foro.php');
?>