<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Evento::borrarEvento($_GET['nombre_evento'],$_GET['creador_evento'],$_GET['fecha_evento']);
    
    header('Location: ./eventos.php');
?>