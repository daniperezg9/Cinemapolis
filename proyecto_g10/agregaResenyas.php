<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

    $formReg = new FormularioAnyadirResenya();
    $htmlForm=$formReg->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
    EOS;
    
require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
