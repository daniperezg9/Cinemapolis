<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    
    Mensaje::añadirMensaje($id_foro, $contacto, $mensaje, $fecha_envio);
    
    header('Location: ./foro.php');
?>