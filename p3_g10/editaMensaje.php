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
    $fecha_envio=$conn->real_escape_string($_SESSION['fecha_envio']) ;
    $mensaje=$conn->real_escape_string($_POST['mensaje']);

    $query = "UPDATE foro SET mensaje = '$mensaje (EDITADO)' WHERE  fecha_envio = '$fecha_envio'";
    // Realizamos la consulta
    $result = $conn->query($query);
    
    header('Location: ./foro.php');
?>