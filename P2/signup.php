<?php session_start();?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Sign up</title>
    </head>
    <body>
        <div id="contenedor"> <!-- Inicio del contenedor -->
            <main>
                <?php
                //Mensaje de error si el registro de usuario falla
                if(isset($_SESSION['signupFallido']) && $_SESSION['signupFallido']== true){

                    echo "<h1>Error</h1>
                    <p>La dirección de correo ya tiene asociada una cuenta.</p>";
                }
                ?>

                <!--Formulario para registrarse-->
                <form action = "./registraUsuario.php" method = "post">
                    <fieldset>
                        <legend>Crea una cuenta</legend>
                        Nombre:<br> <input type="text" name="nombre"><br>
                        Correo electrónico:<br> <input type="text" name="contacto"><br>
                        Contraseña:<br> <input type="password" name="password"><br>	
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form>    
            </main>
        </div> <!-- Fin del contenedor -->

    </body>

</html>
