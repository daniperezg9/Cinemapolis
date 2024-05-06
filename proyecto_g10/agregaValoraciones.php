<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    //abrimos conexión 

    $formReg = new FormularioAnyadirValoracion();
    $htmlForm=$formReg->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
    EOS;
    //$url_destino = './resenyasYvaloraciones.php?titulo=' . urlencode($pelicula);
    //header('Location:' . $url_destino);
?>