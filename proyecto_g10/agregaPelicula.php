<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Agrega pelicula';

$contenidoPrincipal = '';

if(isset($_SESSION['login']) && isset($_SESSION['admin']) && $_SESSION['login'] && $_SESSION['admin']){
    
    $contenidoPrincipal .= "<form action='registraPelicula.php' method='POST' enctype='multipart/form-data'>
    <p>Elija la imagen de la película:<p/>
    <input type='file' name='archivo'>
    <p>Descripción de la imagen:<p/>
    <input type='text' name='alt'>
    <br/>
    <p>Título de la película:<p/>
    <input type='text' name='pelicula'>
    <br/>
    <p>Descripción de la película:<p/>
    <input type='text' name='desc'>
    <br/>
    <p>Fecha de estreno de la película:<p/>
    <input type='date' name='fecha_estreno'>
    <br/>
    <p>Género principal de la película:<p/>
    <input type='text' name='genero'>
    <br/>
    <input type='submit' name='submit' value='Subir película'>
    </form>";
} 
else {
    $contenidoPrincipal .= $contenidoPrincipal = <<<EOS
    <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
    <h2>Para acceder a la lista de películas es necesario haber iniciado sesión como administrador. <a href='login.php'>Login</a></h2>
    EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
