<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    //abrimos conexión 
    Foro::añadirForo($id_foro, $contacto, $descripcion);

    header('Location: ./foro.php');
?>

