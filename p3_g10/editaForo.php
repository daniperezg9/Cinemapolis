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
    $id_foro=$conn->real_escape_string($_POST['id_foro']) ;
    $contacto=$conn->real_escape_string($_POST['contacto']);
    $descripcion=$conn->real_escape_string($_POST['descripcion']);

    Foro::modificarForo($id_foro,$contacto,$descripcion);
    
    header('Location: ./foro.php');
?>