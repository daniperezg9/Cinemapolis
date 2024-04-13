<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Resenyas::borrarResenya($_POST['contacto'],$_POST['pelicula']);
    $url_destino = './reseñasYvaloraciones.php?titulo=' . urlencode($pelicula);
    header('Location:' . $url_destino);
?>