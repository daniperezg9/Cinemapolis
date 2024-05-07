<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Evento::borrarEvento($_POST['nombre_evento'],$_POST['creador_evento'],$_POST['fecha_evento']);
    
    header('Location: ./eventos.php');
?>