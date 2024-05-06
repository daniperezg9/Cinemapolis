<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

//Definicion de constantes
//Parametros de acceso de la base de datos
//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
    
    $result = Pelicula::ListaPeliculas();

    // Preparamos el contenido principal
    if(isset($_SESSION['admin'])&&$_SESSION['admin']==0){
    $contenidoPrincipal = <<<EOS
    <div id="contenedor">
        <table border='1'>
            <tr><th>Imagen</th><th>Título</th><th>Descripción</th></tr>
    EOS;
    }
    else{
        $contenidoPrincipal = <<<EOS
    <div id="contenedor">
        <table border='1'>
            <tr><th>Imagen</th><th>Título</th><th>Descripción</th><th>Modificar pelicula</th><th>Borrar pelicula</th></tr>
    EOS;
    }
    if($result)
    while ($row=$result->fetch_array()) {
        $img=$row['direccion_fotografia'];
        $alt=$row['alt'];
        $contenidoPrincipal .= <<<EOS
            <tr id = 'resenyas'>
                <td><img src='$img' alt='$alt' width='100' height='120'/></td>
                <td><a href='./resenyasYvaloraciones.php?titulo={$row['titulo']}'>{$row['titulo']}</a></td>
                <td>{$row['descripcion']}</td>
        EOS;
        if(isset($_SESSION['admin'])&&$_SESSION['admin']==1){ //Si eres admin puedes borrarlo.
            $contenidoPrincipal .= "<td>";
            $contenidoPrincipal .= <<< EOS
            <p><a class = "modificaPeli" href='modificaPelicula.php?titulo={$row['titulo']}'>Modificar Pelicula</a></p>
            EOS;
            $contenidoPrincipal .= "</td>";

            $contenidoPrincipal .= "<td>";
            $contenidoPrincipal .= <<< EOS
            <p><a class = "borrarPeli" href='borrarPelicula.php?titulo={$row['titulo']}'>Borrar Pelicula</a></p>
            EOS;
            $contenidoPrincipal .= "</td>";
        }

        $contenidoPrincipal .= <<<EOS
        </tr>
        EOS;
    }
    $contenidoPrincipal .= <<<EOS
        </table>
    </div>
    EOS;

}
else{ //Sino mostramos un error por no haber iniciado sesión

    $contenidoPrincipal = <<<EOS
    <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
    <h2>Para acceder a la lista de películas es necesario haber iniciado sesión. <a href='login.php'>Login</a></h2>
    EOS;
}

$tituloPagina = 'Lista de películas';

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
