<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Pelicula::borrarPelicula(filter_var($_GET['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    
    header('Location: ./listaPeliculas.php');
?>