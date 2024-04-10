<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
?>

<!DOCTYPE html>
<html lang ="es">
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" />-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Reseña realizada</title>
    </head>

    <body>
        <div id="contenedor">
            <?php 
                
                
                    if(isset($_SESSION['login'])&&$_SESSION['login']){
                        echo "<form action='registraPelicula.php' method='POST' enctype='multipart/form-data'>
                        <input type='file' name='archivo'>
                        <p>Descripción de la imagen:<p/>
                        <input type='text' name='alt'>
                        <br/>
                        <p>Título de la pelicula:<p/>
                        <input type='text' name='pelicula'>
                        <br/>
                        <p>descripción de la pelicula:<p/>
                        <input type='text' name='desc'>
                        <br/>
                        <p>fecha de estreno de la pelicula:<p/>
                        <input type='date' name='fecha_estreno'>
                        <p>Genero principal de la pelicula:<p/>
                        <input type='text' name='genero'>
                        <input type='submit' name='submit' value='Subir pelicula'>
                      </form>";
                    }
                    

                
            ?>
        </div>
    </body>
</html>
