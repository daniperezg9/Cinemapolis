<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

    $idforo=$_GET['foro'];
    $idforo=filter_var($idforo,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $foro= Foro::mismoForo($idforo, $_SESSION['contacto']);

    if(!$foro){
        echo 'disponible';
    }
    else{
        echo 'existe';
    }

?>