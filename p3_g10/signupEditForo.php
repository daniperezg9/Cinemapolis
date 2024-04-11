<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';


$tituloPagina = 'Sign up Foro Edit';

$contenidoPrincipal = <<<EOS
    <form action =  "./editaForo.php?contacto=$_GET[contacto]&id_foro=$_GET[id_foro]"  method = "post">
    <fieldset>
        <legend>Edita Foro</legend>
        Descripcion: <br> <input type="text" name="descripcion" value="$_GET[descripcion]">
        <input type="submit" name="Enviar">
    </fieldset>
    </form>    
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';