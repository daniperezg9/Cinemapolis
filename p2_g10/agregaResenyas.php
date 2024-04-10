<?php
session_start();
//Definicion de constantes
//Parametros de acceso de la base de datos
    define('BD_HOST', 'localhost');
    define('BD_USER', 'usuarios');
    define('BD_PASS', 'usuariospass');
    define('BD_NAME', 'cinemapolis');
    //abrimos conexión 
    if(isset($_SESSION['login'])&&$_SESSION['login']){
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        
        $resenya = $conn->real_escape_string($_POST['resenya']);
        $pelicula = $conn->real_escape_string($_POST['pelicula']);
        $contacto=$conn->real_escape_string($_SESSION['contacto']);
        $query = "SELECT * FROM resenyas WHERE contacto = '$contacto' AND pelicula='$pelicula'";

        $result = $conn->query($query);
        if ($result->num_rows >0){
            $resenya_hecha=FALSE;
        }
        else{
            $query = "INSERT INTO resenyas (contacto, pelicula, mensaje) VALUES ('$contacto', '$pelicula', '$resenya')";
            $result = $conn->query($query);
            $resenya_hecha=TRUE;
        }
        $conn->close();
    }
    else{
        $resenya_hecha=FALSE;
    }
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
                if($resenya_hecha){
                    echo "<h1>Reseña realizada.</h1>
                    <p>La reseña para la pelicula ''{$pelicula}'' se ha realizado de manera satisfactoria</p>  ";
                }
                else{
                    if(isset($_SESSION['login'])&&$_SESSION['login']){
                        echo "<h1>Error.</h1>
                        <p>Esta cuenta ya ha realizado una reseña para la pelicula ''{$pelicula}''";
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
