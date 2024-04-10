<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
$_SESSION["fecha_envio"] = $_GET["fecha_envio"];

$tituloPagina = 'Sign up Mensaje Edit';

$contenidoPrincipal = <<<EOS
    <form action =  "./editaMensaje.php"  method = "post">
    <fieldset>
        <legend>Edita Mensaje</legend>
        Mensaje:<br> <input type="text" name="mensaje"><br>
        <input type="submit" name="Enviar">
    </fieldset>
    </form>    
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';


/*
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Edit Mensaje</title>
    </head>
    <body>
        <div id="contenedor"> <!-- Inicio del contenedor -->
            <main>
                <!--Formulario para registrarse-->
                
                <form action =  "./editaMensaje.php"  method = "post">
                    <fieldset>
                        <legend>Edita Mensaje</legend>
                        Mensaje:<br> <input type="text" name="mensaje"><br>
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form>    
            </main>
        </div> <!-- Fin del contenedor -->

    </body>

</html>*/