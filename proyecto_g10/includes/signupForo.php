<?php 
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sign up Foro';

$formReg = new FormularioAnyadirForo();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';