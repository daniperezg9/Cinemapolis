<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

	$titulo_peli=$_GET['titulo_nueva'];
    $titulo_peli=filter_var($titulo_peli,FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $peli=Pelicula::buscaPelicula($titulo_peli);

	if($peli===FALSE){
        echo 'disponible';
	}
	else{
        echo 'existe';
	}

?>