<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Agrega pelicula';

$contenidoPrincipal = '';

if(isset($_SESSION['login']) && isset($_SESSION['admin']) && $_SESSION['login'] && $_SESSION['admin']){
    $formReg=new FormularioModificarEvento();
    $htmlForm=$formReg->gestiona();
    $contenidoPrincipal=<<<EOS
        $htmlForm
    EOS;
} 
else {
    $contenidoPrincipal .= $contenidoPrincipal = <<<EOS
    <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
    <h2>Para acceder a la lista de películas es necesario haber iniciado sesión como administrador. <a href='login.php'>Login</a></h2>
    EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>