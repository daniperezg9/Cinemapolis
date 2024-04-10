<?php
	function opcionesInicioSesion(){
		
        if(!isset($_SESSION["login"])) { //Si el usuario no tiene una sesión iniciada le da la opción de iniciar una o registrarse

            echo "<p>Estás navegando sin iniciar sesión. <a href='./login.php'>Iniciar sesión</a></p>";

            echo "<p>¿No tienes cuenta? <a href='./signup.php'>Crear cuenta</a></p>";
		}
		else {  //Si el usuario tiene una sesión iniciada le saluda y en caso de ser administrador, se lo muestra

			echo "<p>Bienvenido <strong>{$_SESSION['nombre']}</strong>. <a href='logout.php'>(Salir)</a></p>";
            
            if(isset($_SESSION['admin'])&&$_SESSION['admin']){
                
                echo"<p>Tienes rango de administrador.</p>";
            }

			//Si has iniciado sesión te muestra los enlaces de las demás páginas			
			echo '<p><a href="listaPeliculas.php">Ver lista de películas</a></p>';
			echo '<p><a href="reseñasYvaloraciones.php">Ver reseñas y valoraciones</a></p>';
			echo '<p><a href="eventos.php">Ver eventos</a></p>';
			echo '<p><a href="foro.php">Ir al foro</a></p>';
			
		}
	}
?>


<header>
        <h1>Bienvenido a Cinemapolis.io</h1>
		<div class="inicioSesion">
			<?php
				opcionesInicioSesion();
			?>
		</div>
</header>