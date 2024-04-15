<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    //abrimos conexión 
    Foro::añadirForo($_POST['id_foro'], $_SESSION['contacto'], $_POST['descripcion']);

    header('Location: ./foro.php');
?>

