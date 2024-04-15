<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Pelicula::borrarPelicula($_GET['titulo']);
    
    header('Location: ./listaPeliculas.php');
?>