<?php session_start() ?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8">
<title>Foro</title>
</head>

<body>

<div id="contenedor"> <!-- Inicio del contenedor -->
	<main>
	  <article>
        <?php
            if (!isset($_SESSION['login'])) {
            echo "<h1>Bienvenido al foro!</h1>
                  <p> Registrate para poder usar el foro:  <a href='login.php'>Login</a></p>";
            }
            else {
            echo "<h1>Bienvenido al foro {$_SESSION['nombre']}: interactúa con quien quieras!</h1>
                  <p>Vuelve a la página principal: <a href='index.php'>Home. </a></p>
                  <p><a href='logout.php'>Cerrar Sesión</a></p>";
            }
        ?>
	  </article>
	</main>
</div> <!-- Fin del contenedor -->

</body>
</html>