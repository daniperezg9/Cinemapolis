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




/*<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Sign up Foro</title>
    </head>
    <body>
        <div id="contenedor"> <!-- Inicio del contenedor -->
            <main>
                <?php
                //Mensaje de error si el registro de usuario falla
                /*if(isset($_SESSION['signupFallido']) && $_SESSION['signupFallido']== true){

                    echo "<h1>Error</h1>
                    <p>La dirección de correo ya tiene asociada una cuenta.</p>";
                }
                ?>

                <!--Formulario para registrarse-->
                <form action = "./registraForo.php" method = "post">
                    <fieldset>
                        <legend>Crea un nuevo Foro</legend>
                        ID del foro:<br> <input type="text" name="id_foro"><br>
                        Descripción básica del foro:<br> <input type="text" name="descripcion"><br>	
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form>    
            </main>
        </div> <!-- Fin del contenedor -->

    </body>

</html>*/