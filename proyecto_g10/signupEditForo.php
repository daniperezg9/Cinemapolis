<?php 
use cinemapolis\FormularioEditarForo as FormularioEditarForo;
require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Sign up Foro Edit';

$formReg = new FormularioEditarForo();
$htmlForm = $formReg->gestiona();

$contenidoPrincipal = <<<EOS
    $htmlForm
EOS;



require __DIR__.'/includes/vistas/plantillas/plantilla.php';

/*$contenidoPrincipal = <<<EOS
    <form action =  "./editaForo.php"  method = "post">
    <fieldset>
        <legend>Edita Foro</legend>
        <input type="hidden" name="id_foro" value="$_POST[id_foro]">
        <input type="hidden" name="contacto" value="$_POST[contacto]">
        Descripcion: <br> <input type="text" name="descripcion" value="$_POST[descripcion]">
        <input type="submit" name="Enviar">
    </fieldset>
    </form>    
EOS;*/

require __DIR__.'/includes/vistas/plantillas/plantilla.php';