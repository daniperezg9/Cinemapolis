<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sign up Foro';

$contenidoPrincipal = <<<EOS
    <form action = "./registraForo.php" method = "post">
    <fieldset>
        <legend>Crea un nuevo Foro</legend>
        Nombre del foro:<br> <input type="text" name="id_foro"><br>
        Descripción básica del foro:<br> <input type="text" name="descripcion"><br>	
        <input type="submit" name="Enviar">
    </fieldset>
    </form> 
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';