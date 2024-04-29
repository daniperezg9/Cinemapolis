<?php 
require_once __DIR__.'/includes/config.php';
use cinemapolis\FormularioAñadirMensaje as FormularioAñadirMensaje;

$tituloPagina = 'Sign up Mensaje';

$formReg = new FormularioAñadirMensaje();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';