<?php session_start();?>

<?php
    //Elimina todos los datos de sesión del usuario
    session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Log out</title>
    </head>
    <body>
        <div id="contenedor"> <!-- Inicio del contenedor -->
            <main id="contenido">
                <?php
                
                //Reenvía al usuario a la página principal con la sesión actual cerrada
                header('Location: ./index.php');
                exit;
                ?>
            </main>
        </div> <!-- Fin del contenedor -->
        

    </body>

</html>