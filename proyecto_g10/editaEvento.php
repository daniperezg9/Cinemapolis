<?php
    namespace cinemapolis;
    require_once __DIR__.'/includes/config.php';
    //Definicion de constantes
    //Parametros de acceso de la base de datos
        
        Evento::modificarEvento($_POST['nombre_evento'],$_POST['descripcion_evento'],$_POST['fecha_evento'],$_POST['nombre_evento_old'],$_POST['fecha_evento_old'],$_POST['creador_evento_old'],$_POST['fecha_actual']);
        
        header('Location: ./eventos.php');
?>