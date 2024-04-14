<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    Valoracion::modificarValoraciones($_POST['contacto'],$_POST['pelicula'],$_POST['puntuacion'], );
    $url_destino = './resenyasYvaloraciones.php?titulo=' . $_POST['pelicula'];
    header('Location:' . $url_destino);
?>