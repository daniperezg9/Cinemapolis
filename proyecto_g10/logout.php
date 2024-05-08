<?php 
    namespace cinemapolis\src;
    require_once __DIR__.'/includes/config.php';

    if(isset($_SESSION['login'])){
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['nombre'])){
        unset($_SESSION['nombre']);
    }
    if(isset($_SESSION['contacto'])){
        unset($_SESSION['contacto']);
    }
    if(isset($_SESSION['admin'])){
        unset($_SESSION['admin']);
    }

    //Elimina todos los datos de sesión del usuario
    session_destroy();

    header('Location: ./index.php');
?>
