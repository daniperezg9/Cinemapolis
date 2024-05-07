<?php
function opcionesInicioSesion(){
    $rutaApp = RUTA_APP;
    $html = '';
    if(!isset($_SESSION["login"])) { // Si el usuario no tiene una sesión iniciada le da la opción de iniciar una o registrarse
        $html .= "<p class='opcion'>Estás navegando sin iniciar sesión. <a href='{$rutaApp}/login.php'>Iniciar Sesión</a></p>";
        $html .= "<p class='opcion'>¿No tienes cuenta? <a href='{$rutaApp}/signup.php'>Crear cuenta</a></p>";
    }
    else {	// Si el usuario tiene una sesión iniciada le saluda y en caso de ser administrador, se lo muestra
        $html .= "<p class='opcion'>Usuario: <strong>{$_SESSION['nombre']}</strong> <a href='{$rutaApp}/logout.php'>(salir)</a></p>";
        if(isset($_SESSION['admin']) && $_SESSION['admin']){
            $html .= "<p class='opcion'>Tienes rango de administrador.</p>";
        }
    }
    return $html; // Devuelve la cadena generada
}
?>

<header>
    <div class="logo-container">
	<img src="<?= RUTA_IMGS; ?>/logoCinemapolis.jpg" alt="CINEMAPOLIS" id ="CINEMAPOLIS">
	</div>  

	<div class="inicioSesion">
		<h1 class= "saludo"> Bienvenido a Cinemapolis.io</h1>
		<?= opcionesInicioSesion(); // Imprime la cadena devuelta por la función?> 
	</div>

    <img src="<?= RUTA_IMGS; ?>/cinemaPack.png" alt="cinemaPack" id="cinemaPack">
</header>
