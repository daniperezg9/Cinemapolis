<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    $nombre_evento = $_POST['nombre_evento'];
    $descripcion_evento = $_POST['descripcion_evento'];
    $fecha_evento = $_POST['fecha_evento'];
    $fecha_actual = $_POST['fecha_actual'];
    $creador_evento = $_POST['creador_evento'];

    Evento::añadirEvento($nombre_evento,$descripcion_evento,$fecha_evento,$fecha_actual,$creador_evento);

    header('Location: eventos.php');
    
?>