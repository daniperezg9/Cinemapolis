<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
$tituloPagina = 'Edita valoracion';

$formReg = new FormularioModificarValoracion();
$htmlForm=$formReg->gestiona();
$contenidoPrincipal=<<<EOS
    $htmlForm
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>