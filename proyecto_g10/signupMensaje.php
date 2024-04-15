<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sign up Mensaje';

$contenidoPrincipal = <<<EOS
    <form action =  "./registraMensaje.php"  method = "post">
    <fieldset>
        <legend>Mensaje nuevo</legend>
        <input type="hidden" name="id_foro" value="$_POST[id_foro]">
        Mensaje:<br> <input type="text" name="mensaje"><br>
        <input type="submit" name="Enviar">
    </fieldset>
    </form>    
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';