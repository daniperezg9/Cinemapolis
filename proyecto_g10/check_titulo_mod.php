<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

	$titulo_peli_mod=$_GET['titulo_peli_mod'];
    $titulo_peli_mod=filter_var($titulo_peli_mod,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
	$titulo_peli_pre=$_GET['titulo_peli_pre'];
    $titulo_peli_pre=filter_var($titulo_peli_pre,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    $peli=Pelicula::buscaPelicula($titulo_peli_mod);

	if($peli===FALSE){
        echo 'disponible';
	}
	else{
        if($titulo_peli_mod == $titulo_peli_pre){
            echo 'disponible';
        }
        else{
            echo 'existe';
        }
	}

?>