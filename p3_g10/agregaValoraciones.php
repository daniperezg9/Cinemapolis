<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    //abrimos conexión 
        
    $conn = Aplicacion::getInstance()->getConexionBd();
    if ($conn->connect_error){
        die("La conexión ha fallado" . $conn->connect_error);
    }
    
    $puntuacion = $conn->real_escape_string( $_POST['puntuacion'] );
    $pelicula = $conn->real_escape_string($_POST['pelicula'] );
    $contacto= $conn->real_escape_string($_SESSION['contacto']);

    Valoracion::añadirValoracion($pelicula,$contacto,$puntuacion);

    Header("Location:listaPeliculas.php");
?>