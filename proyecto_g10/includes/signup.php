<?php 
namespace cinemapolis\src;

require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sign up';

$formReg=new FormularioAnyadirUsuario();
$htmlForm=$formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';