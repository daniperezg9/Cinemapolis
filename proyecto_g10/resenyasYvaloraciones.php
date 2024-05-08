<?php //TODO Comprobar si funciona correctamente
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
if (!isset($_SESSION['valoracion_realizadas'])) {
    $_SESSION['valoracion_realizadas'] = [];
}
if (!isset($_SESSION['reseñas_realizadas'])) {
    $_SESSION['reseñas_realizadas'] = [];
}

//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
    
    $tituloPeli=filter_var($_GET['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $row = Pelicula::buscaPelicula($tituloPeli);
    $generoPeli = $row->get_genero();
    $fecha_estreno = $row->get_fecha_estreno();
    $dir= $row->get_dir_foto();
    $alt=$row->get_alt();
    $descr=$row->get_descripcion();
    $resultResenyas = Resenyas::ListaResenyas($tituloPeli);
    $resultValoracion = Valoracion::ListaValoracion($tituloPeli);
    
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
    if (!$resultResenyas){
        $contenidoPrincipal .= <<<EOS
                    <p>No hay reseñas para esta película.</p>
                EOS;        
    }else{
        $i=0;
        //while ($row=$resultResenyas->fetch_array()) {
        while($i<count($resultResenyas)){
            $msg=$resultResenyas[$i]->get_msg();
            $contacto=$resultResenyas[$i]->get_contacto();
        
            $contenidoPrincipal .= <<<EOS
                <div>
                <tr id = 'resenyas'>
                <td><strong>{$contacto}:</strong></td> <td>{$msg}</td>
                </div>
            EOS;
            if(Admin::esAdmin($_SESSION)){ //Si eres admin puedes borrarlo.
                $contenidoPrincipal .= "<td>";
                $contenidoPrincipal .= <<< EOS
                    <form action="borrarResenya.php" method="post" style="display: inline;">
                        <input type="hidden" name="contacto" value="$contacto">
                        <input type="hidden" name="pelicula" value="{$tituloPeli}">
                        <button type="submit"> Borrar reseña </button>
                    </form>
                EOS;
                $contenidoPrincipal .= <<<EOS
                        <p><a class="editaResenya" href="editaResenyas.php?titulo=$tituloPeli&contacto=$contacto">Editar reseña</a></p>
                    EOS;
            }
            else if($_SESSION['contacto']==$contacto){
                $contenidoPrincipal .= "<td>";
                $contenidoPrincipal .= <<< EOS
                    <form action="borrarResenya.php" method="post" style="display: inline;">
                        <input type="hidden" name="contacto" value="$contacto">
                        <input type="hidden" name="pelicula" value="{$tituloPeli}">
                        <button type="submit"> Borrar reseña </button>
                    </form>
                EOS;
                
                $contenidoPrincipal .= <<<EOS
                        <p><a class="editaResenya" href="editaResenyas.php?titulo=$tituloPeli&contacto=$contacto">Editar reseña</a></p>
                    EOS;
                
                $contenidoPrincipal .= "</td>";
            }
    
            $contenidoPrincipal .= <<<EOS
            </tr>
            EOS;
            $i++;
        }
    }
    if(!$resultValoracion){
        $contenidoPrincipal .= <<<EOS
                    <p>No hay valoraciones para esta película.</p>
                EOS;         
    }else{
        if($resultValoracion){
            // while ($row=$resultValoracion->fetch_array()) {
             $j=0;
         while($j<count($resultValoracion)){
             $puntuacion=$resultValoracion[$j]->get_puntuacion();
             $contacto=$resultValoracion[$j]->get_contacto();
                 $contenidoPrincipal .= <<<EOS
                     <div>
                     <tr id = 'valoracion'>
                     <td><strong>{$contacto}:</strong></td><td>{$puntuacion}</td>
                     </div>
                 EOS;
                 if(Admin::esAdmin($_SESSION)){ //Si eres admin puedes borrarlo.
                     $contenidoPrincipal .= "<td>";
                     $contenidoPrincipal .= <<<EOS
                         <form action="borrarValoraciones.php" method="post" style="display: inline;">
                             <input type="hidden" name="contacto" value="$contacto">
                             <input type="hidden" name="pelicula" value="$tituloPeli">
                             <button type="submit"> Borrar valoración </button>
                         </form>
                     EOS;
                     $contenidoPrincipal .= <<<EOS
                         <p><a class="editaValoracion" href="editaValoraciones.php?titulo=$tituloPeli">Editar Valoración</a></p>
                     EOS;
                     $contenidoPrincipal .= "</td>"; 
                 }
                 else if($_SESSION['contacto']== $contacto){
                     $contenidoPrincipal .= "<td>";
                     $contenidoPrincipal .= <<<EOS
                         <form action="borrarValoraciones.php" method="post" style="display: inline;">
                             <input type="hidden" name="contacto" value="{$contacto}">
                             <input type="hidden" name="pelicula" value="{$tituloPeli}">
                             <button type="submit"> Borrar valoración </button>
                         </form>
                     EOS;
                     $contenidoPrincipal .= <<<EOS
                         <p><a class="editaValoracion" href="editaValoraciones.php?titulo=$tituloPeli">Editar Valoración</a></p>
                     EOS;
                     $contenidoPrincipal .= "</td>";
                 }
           
                 $contenidoPrincipal .= <<<EOS
                 </tr>
                 EOS;
                $j++;
             }
         }
    }
    $contenidoPrincipal .= <<<EOS
                </div>
                <div class="rating">
    EOS;             
    //$v=new Valoracion();
    //$contenidoPrincipal.= v->getMedia();
    if(!isset($_SESSION['reseñas_realizadas'][$tituloPeli]) &&
    !isset($_SESSION['reseñas_realizadas'][$tituloPeli][$_SESSION['contacto']])){
        $contenidoPrincipal.=<<<EOS
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <p><a class="anyadeResenya" href="agregaResenyas.php?titulo=$tituloPeli">Añadir reseña</a></p>
                </div>
    EOS;
    }
    
        if(!isset($_SESSION['valoracion_realizadas'][$tituloPeli]) && !isset($_SESSION['valoracion_realizadas'][$tituloPeli][$_SESSION['contacto']])){
            $contenidoPrincipal.=<<<EOS
                        <div class="col-6">
                            <p><a class="anyadeValoracion" href="agregaValoraciones.php?titulo=$tituloPeli">Añadir valoración</a></p>
                        </div>
                    </div>
                </div>
                </section>
            EOS;
        }
    

}
else{

    $contenidoPrincipal = <<<EOS
    <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
    <h2>Para acceder al foro es necesario haber iniciado sesión. <a href='login.php'>Login</a></h2>
    EOS;
}

$tituloPagina = 'Reseñas y valoraciones';


require __DIR__.'/includes/vistas/plantillas/plantilla.php';