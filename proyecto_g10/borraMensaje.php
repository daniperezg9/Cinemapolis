<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Mensaje::borraMensaje($_POST['contacto'], $_POST['fecha_envio']);
    
    header('Location: ./listaForos.php');
?>