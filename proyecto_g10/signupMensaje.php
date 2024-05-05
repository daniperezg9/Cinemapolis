<?php 
require_once __DIR__.'/includes/config.php';
use cinemapolis\FormularioAnyadirMensaje as FormularioAnyadirMensaje;

$tituloPagina = 'Sign up Mensaje';

$formReg = new FormularioAnyadirMensaje();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';