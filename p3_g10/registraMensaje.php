<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    $fecha_envio=date("Y-m-d H:i:s");
    Mensaje::añadirMensaje($_POST['id_foro'], $_SESSION['contacto'], $_POST['mensaje'], $fecha_envio);
    
    header('Location: ./foro.php');
?>