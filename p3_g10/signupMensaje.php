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

/*<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Sign up Mensaje Foro</title>
    </head>
    <body>
        <div id="contenedor"> <!-- Inicio del contenedor -->
            <main>
                <!--Formulario para registrarse-->
                
                <form action =  "./registraMensaje.php"  method = "post">
                    <fieldset>
                        <legend>Mensaje nuevo</legend>
                        Mensaje:<br> <input type="text" name="mensaje"><br>
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form>    
            </main>
        </div> <!-- Fin del contenedor -->

    </body>

</html>*/