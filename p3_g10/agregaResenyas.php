<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    $resenya =$_POST['resenya'];
    $pelicula =$_POST['pelicula'];
    $contacto=$_SESSION['contacto'];

    Resenyas::añadirResenya($pelicula,$contacto,$resenya);

    $url_destino = './resenyasYvaloraciones.php?titulo=' . $_POST['pelicula'];
    header('Location:' . $url_destino);
    
?>
