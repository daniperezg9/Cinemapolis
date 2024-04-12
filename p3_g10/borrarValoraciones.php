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
    $pelicula=$conn->real_escape_string($_POST['pelicula']) ;
    $contacto=$conn->real_escape_string($_POST['contacto']) ;

    Valoracion::borrarValoracion($contacto,$pelicula);
    $pelicula_encoded = urlencode($pelicula);
    header('Location: ./listaPeliculas.php');
?>