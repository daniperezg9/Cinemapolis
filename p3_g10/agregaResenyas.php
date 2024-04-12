<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if (mysqli_connect_errno()){
        die("La conexión ha fallado" .mysqli_connect_error());
    }
    
    $resenya = $conn->real_escape_string($_POST['resenya']);
    $pelicula = $conn->real_escape_string($_POST['pelicula']);
    $contacto=$conn->real_escape_string($_SESSION['contacto']);

    Resenyas::añadirResenya($pelicula,$contacto,$resenya);

    $url_destino = './reseñasYvaloraciones.php?titulo=' . urlencode($pelicula);
    header('Location:' . $url_destino);
    
?>
