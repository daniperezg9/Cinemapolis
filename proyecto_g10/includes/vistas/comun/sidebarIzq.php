<nav id="sidebarIzq">
	<h2 class = navegacion>Navegación</h2>
	<!--  Muestra los enlaces de las demás páginas -->
	<ul>
		<li><a href="<?= RUTA_APP ?>/index.php">Inicio</a></li>
		<?php
		if(isset($_SESSION['login']) && $_SESSION['login']){
			echo '<li><a href="'. RUTA_APP .'/modificaUsuario.php">Ver perfil</a></li>';
		}
		?>
		<li><a href="<?= RUTA_APP ?>/listaPeliculas.php">Ver lista de películas</a></li>
		<?php
		if(isset($_SESSION['login']) && isset($_SESSION['admin']) && $_SESSION['login'] && $_SESSION['admin']){
			echo '<li><a href="'. RUTA_APP .'/agregaPelicula.php">Añadir nueva película</a></li>';
		}
		?>
		<li><a href="<?= RUTA_APP ?>/eventos.php">Eventos</a></li>
		<li><a href="<?= RUTA_APP ?>/listaForos.php">Foro</a></li>
	</ul>

	<img src="<?= RUTA_IMGS; ?>/entradaCine.png" alt="imgSideIzq" id="imgSideIzq">
</nav>
