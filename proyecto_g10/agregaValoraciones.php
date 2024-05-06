<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

    $tituloPagina = 'Agrega valoración';

    $formReg = new FormularioAnyadirValoracion();
    $htmlForm=$formReg->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
    EOS;
    
    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>