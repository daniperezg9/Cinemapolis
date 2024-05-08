<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

	$usuario=$_GET['correo'];
    $usuario=filter_var($usuario,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user=Usuario::buscaUserPorCorreo($usuario);
	if(!$user){
        echo 'disponible';
	}
	else{
        echo 'existe';
	}

?>