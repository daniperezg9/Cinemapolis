<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <title><?= $tituloPagina ?></title>
    <link rel="stylesheet" type="text/css" href="<?= RUTA_CSS ?>/estilo.css" />
	<link rel="icon" type="image/x-icon" href="<?= RUTA_IMGS ?>/iconoWeb.ico" />
</head>
<body>
	<div id="contenedor">
	<?php
	require(RAIZ_APP.'/vistas/comun/cabecera.php');
	require(RAIZ_APP.'/vistas/comun/sidebarIzq.php');
	?>
		<main>
			<article>
				<?= $contenidoPrincipal ?>
			</article>
		</main>
	<?php
	require(RAIZ_APP.'/vistas/comun/sidebarDer.php');
	require(RAIZ_APP.'/vistas/comun/pie.php');
	?>
	</div>
	<script type="text/javascript" src="JS/jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="JS/correo_registro.js"></script>
	<script type="text/javascript" src="JS/check_pelicula.js"></script>
	<script type="text/javascript" src="JS/modifica_pelicula.js"></script>
	<script type="text/javascript" src="JS/check_foro.js"></script>
</body>
</html>
