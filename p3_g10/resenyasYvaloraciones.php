<?php //TODO Comprobar si funciona correctamente
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
    
    $tituloPeli=$_GET['titulo'];
    $row = Pelicula::buscaPelicula_genero($tituloPeli);
    $generoPeli = $row['genero'];
    $fecha_estreno = $row['fecha_estreno'];
    $dir= $row['dir'];
    $alt=$row['alt'];
    $descr=$row['descr'];
        
    
    
    $contenidoPrincipal = <<<EOS
    <div id="Titulo">
        <h1>$tituloPeli</h1>
        <ul>
        <li> $generoPeli </li>
        <li> $fecha_estreno </li>
        </ul>
    </div>
    <div id="Imagen">
        <img src='$dir' alt='$alt' width='300' height='360'/>
        <p> Sinopsis </p>
        <p>$descr</p>
    </div>
    <section id="app">
        <div class="container">
            <div class="row">
                <div class="comment">
    EOS;
    $contenidoPrincipal .= Resenyas::mostrarResenyas($tituloPeli);
    $contenidoPrincipal .= Valoracion::mostrarValoracion($tituloPeli);

    
    $contenidoPrincipal .= <<<EOS
                </div>
                <div class="rating">
    EOS;             
    //$v=new Valoracion();
    //$contenidoPrincipal.= v->getMedia();
    $contenidoPrincipal.=<<<EOS
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <form action="./agregaResenyas.php" method= "post">
                        <input name= "resenya" class="input" placeholder="Escriba un comentario">
                        <input type="hidden" name= "pelicula" value="$tituloPeli">
                        <button type="submit" class='primaryContained float-right'>Add Comment</button>
                    </form>
                </div>
                <div class="col-6">
                    <form action="./agregaValoraciones.php" method= "post">
                        <input type="number" name="puntuacion" class="input" placeholder="Puntuación (1-100)" min="0" max="100">
                        <input type="hidden" name= "pelicula" value="$tituloPeli">
                        <button type="submit" class='primaryContained float-right'>Add Rating</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    EOS;

}
else{

    $contenidoPrincipal = <<<EOS
    <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
    <h2>Para acceder al foro es necesario haber iniciado sesión. <a href='login.php'>Login</a></h2>
    EOS;
}

$tituloPagina = 'Reseñas y valoraciones';


require __DIR__.'/includes/vistas/plantillas/plantilla.php';