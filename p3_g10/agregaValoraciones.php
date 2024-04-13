<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    //abrimos conexión 

    $puntuacion = $_POST['puntuacion'] ;
    $pelicula = $_POST['pelicula'] ;
    $contacto=$_SESSION['contacto'];

    Valoracion::añadirValoracion($pelicula,$contacto,$puntuacion);
    $url_destino = './reseñasYvaloraciones.php?titulo=' . urlencode($pelicula);
    header('Location:' . $url_destino);
?>