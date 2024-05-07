<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

    Foro::borraForo($_POST['id_foro'],$_POST['contacto']);
    
    header("Location: listaForos.php");
?>