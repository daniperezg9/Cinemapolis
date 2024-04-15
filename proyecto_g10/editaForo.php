<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    Foro::modificarForo($_POST['id_foro'],$_POST['contacto'],$_POST['descripcion']);
    
    header('Location: ./foro.php');
?>