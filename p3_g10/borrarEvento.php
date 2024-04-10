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

    //buscamos la contraseña ya encriptada ya que es lo que almacenamos (tema de seguridad)
    $nombre_evento=$conn->real_escape_string($_GET['nombre_evento']) ;
    $creador_evento=$conn->real_escape_string($_GET['creador_evento']) ;
    $fecha_evento=$conn->real_escape_string($_GET['fecha_evento']) ;

    Evento::borrarEvento($nombre_evento,$creador_evento,$fecha_evento);
    
    header('Location: ./eventos.php');
?>