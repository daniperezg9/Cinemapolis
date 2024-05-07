<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
    $tituloPagina = 'Agrega reseña';

    $formReg = new FormularioAnyadirResenya();
    $htmlForm=$formReg->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
    EOS;
    
require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
