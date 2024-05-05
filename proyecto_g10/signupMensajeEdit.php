<?php 
use cinemapolis\FormularioEditarMensaje as FormularioEditarMensaje;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sign up Mensaje Edit';

$formReg = new FormularioEditarMensaje();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;

/*$contenidoPrincipal = <<<EOS
    <form action =  "./editaMensaje.php"  method = "post">
    <fieldset>
        <legend>Edita Mensaje</legend>
        <input type="hidden" name="fecha_envio" value="$_POST[fecha_envio]">
        Mensaje:<br> <input type="text" name="mensaje"><br>
        <input type="submit" name="Enviar">
    </fieldset>
    </form>    
EOS;*/

require __DIR__.'/includes/vistas/plantillas/plantilla.php';