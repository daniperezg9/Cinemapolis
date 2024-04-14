<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
$creado=false;
$mensajeError='';
$contenidoPrincipal = '';


//Si se quiere subir una imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
   //Recogemos el archivo enviado por el formulario
   
   $archivo = $_FILES['archivo']['name'];

   //echo"<p> $archivo<p/>";
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
        if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
            $mensajeError='<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
        }
        else {
            if(!$creado=Pelicula::insertaPelicula($_POST['pelicula'],$_POST['desc'],$_POST['alt'],$_POST['fecha_estreno'],$archivo,$temp,$_POST['genero'])){
                $mensajeError='Faltan datos por rellenar o ya existe la pelicula';
            }

            /*$app = Aplicacion::getInstance();
            $conn= $app->getConexionBd();

            if (mysqli_connect_errno()){
                die("error de conexión con BBDD". mysqli_connect_error());
            }
            $titulo =$conn->real_escape_string($_POST['pelicula']) ;
            $descripcion =$conn->real_escape_string($_POST['desc']) ;
            $alt=$conn->real_escape_string($_POST['alt']) ;
            $fecha_estreno=$conn->real_escape_string($_POST['fecha_estreno']) ;
            //echo "<p>  $titulo $descripcion $alt $fecha_estreno <p/>";
            $query = "SELECT titulo FROM peliculas WHERE titulo = '$titulo' ";


            $result = $conn->query($query);
            
            if ($result->num_rows == 0){
                //recuperamos los resultados
                $dir='./images/'.date("Y-m-d-H-i-s-").$archivo;
                if (move_uploaded_file($temp, $dir)) {
                    
                    chmod($dir, 0777);
                    $query = "INSERT INTO peliculas (titulo, descripcion, fecha_estreno,direccion_fotografia,alt) VALUES ('$titulo', '$descripcion', '$fecha_estreno','$dir','$alt')";
                //seteamos con lo devuelto por la consulta
                    $result = $conn->query($query);

                    $creado=true;
                    
                }*/
            


            
        }
    }
    else{
        $mensajeError="<p>No se ha detectado fotografía</p>";
    }
}
else{
    $mensajeError="<h1>Error de conexión a base de datos<h1/><br><p>Intentelo de nuevo mas tarde</p>";
}


if($creado){
    $tituloPagina = 'Pelicula agregada';

    $contenidoPrincipal=<<<EOS
    <h1>Pelicula añadida a la base de datos satisfactoriamente</h1>
    <p>Recomendamos pasarse por la página de la pelicula para hacer una reseña y valoración</p>
    EOS;
    
}
else{
    $tituloPagina = 'Pelicula no agregada';

    $contenidoPrincipal=<<<EOS
    <h1>Error</h1>
    $mensajeError
    EOS;
    
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>