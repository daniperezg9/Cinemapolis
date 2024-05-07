<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Log in';

$mensajeError = '';

$formReg=new FormularioLogin();
    $htmlForm=$formReg->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
    EOS;
require __DIR__.'/includes/vistas/plantillas/plantilla.php';