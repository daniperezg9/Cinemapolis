<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Log in</title>
    </head>
    <body>
        <div id="contenedor"> <!-- Inicio del contenedor -->
            <main>
                <?php
                 //Mensaje de error si el inicio de sesión falla
                if(isset($_SESSION['loginFallido']) && $_SESSION['loginFallido']== true){

                    echo "<h1>Error</h1>
                    <p>La dirección de correo o la contraseña son erróneas.</p>";
                }
                ?>
                
                <!--Formulario para iniciar sesión-->
                <form action = "./procesaLogin.php" method = "post">
                    <fieldset>
                        <legend>Inicia sesión</legend>
                        Correo electrónico:<br> <input type="text" name="contacto"><br>
                        Contraseña:<br> <input type="password" name="password"><br>	
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form>   
            </main>
        </div> <!-- Fin del contenedor -->

    </body>

</html>
