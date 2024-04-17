<?php 
require_once __DIR__.'/includes/config.php';
use cinemapolis\FormularioAñadirForo as FormularioAñadirForo;

$tituloPagina = 'Sign up Foro';

$formReg = new FormularioAñadirForo();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';