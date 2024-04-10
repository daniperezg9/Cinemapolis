<?php
namespace cinemapolis;
$creado=false;
require_once __DIR__.'/includes/config.php';
//Si se quiere subir una imagen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
   //Recogemos el archivo enviado por el formulario
   
   $archivo = $_FILES['archivo']['name'];

   echo"<p> $archivo<p/>";
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else {
            $app = Aplicacion::getInstance();
            $conn= $app->getConexionBd();

            if (mysqli_connect_errno()){
                die("error de conexión con BBDD". mysqli_connect_error());
            }
            $titulo =$conn->real_escape_string($_POST['pelicula']) ;
            $descripcion =$conn->real_escape_string($_POST['desc']) ;
            $alt=$conn->real_escape_string($_POST['alt']) ;
            $fecha_estreno=$conn->real_escape_string($_POST['fecha_estreno']) ;
            echo "<p>  $titulo $descripcion $alt $fecha_estreno <p/>";
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
                    
                }
            }


            
        }
    }
}
else{
    echo"<h1>Ha habido un error.<h1/>";
}
?>

<!DOCTYPE html>
<html lang ="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Registro de pelicula</title>
    </head>

    <body>
        <div id="contenedor">
            <?php 
                if($creado){
                    
                    echo"<h1>Pelicula creada<h1/>";
                    exit;
                }
                else{
                    echo"<h1>Pelicula no creada<h1/>";
                    exit;
                }
            ?>
        </div>
    </body>
</html>