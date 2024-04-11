<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    //abrimos conexión 
    if(isset($_SESSION['login'])&&$_SESSION['login']){
        if(is_numeric($_POST['puntuacion'])){
            $app = Aplicacion::getInstance();
            $conn = $app->getConexionBd();
            if ($conn->connect_error){
                die("La conexión ha fallado" . $conn->connect_error);
            }
            
            $puntuacion = $conn->real_escape_string( $_POST['puntuacion'] );
            
            $pelicula = $conn->real_escape_string($_POST['pelicula'] );
            $contacto= $conn->real_escape_string($_SESSION['contacto']);
    
            $query = "SELECT * FROM valoraciones WHERE contacto = '$contacto' AND pelicula='$pelicula'";
    
            $result = $conn->query($query);

            if ($result->num_rows >0){
                $valoracion_hecha=FALSE;
            }
            else{
                $query = "INSERT INTO valoraciones (contacto, pelicula, puntuacion) VALUES ('$contacto', '$pelicula', '$puntuacion')";
                $result = $conn->query($query);
                $valoracion_hecha=TRUE;
            }
            $valor_invalido=false;
        }
        else{
            $valor_invalido=true;
            $valoracion_hecha=FALSE;
        }
    }
    else{
        $valoracion_hecha=FALSE;
    }
?>

<!DOCTYPE html>
<html lang ="es">
    <head>
        <!--<link rel="stylesheet" type="text/css" href="estilo.css" />-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Valoración realizada</title>
    </head>

    <body>
        <div id="contenedor">
            <?php 
                if($valoracion_hecha){
                    echo "<h1>Valoración realizada.</h1>
                    <p>La valoración para la pelicula ''{$pelicula}'' se ha realizado de manera satisfactoria</p>  ";
                }
                else{
                    if(isset($_SESSION['login'])&&$_SESSION['login']){

                        if($valor_invalido){
                            echo "<h1>Error.</h1>
                            <p>El valor de las valoraciones debe estar entre 0 y 100, <strong>no puede ser ''{$_POST['puntuacion']}''</strong>";
                        }
                        else{
                            echo "<h1>Error.</h1>
                            <p>Esta cuenta ya ha realizado una valoración para la pelicula ''{$pelicula}''";
                        }
                    }
                    else{
                        echo "<h1>Error.</h1>
                        <p>Debes estar logueado para poder realizar reseñas.</p>";
                    }
                }
            ?>
        </div>
    </body>
</html>