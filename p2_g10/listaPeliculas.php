<?php //TODO Comprobar si funciona correctamente
session_start();
//Definicion de constantes
//Parametros de acceso de la base de datos
    define('BD_HOST', 'localhost');
    define('BD_USER', 'usuarios');
    define('BD_PASS', 'usuariospass');
    define('BD_NAME', 'cinemapolis');
    //abrimos conexión 
    if(isset($_SESSION['login']) && $_SESSION['login']) {
        $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        if ($conn->connect_error) {
            die("La conexión ha fallado" . $conn->connect_error);
        }
        
        // Creamos la consulta
        $query = "SELECT * FROM peliculas";
        // Realizamos la consulta
        $result = $conn->query($query);

    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Lista de películas</title>
    </head>
    <?php require "cabecera.php";?>
    <body>
        <div id="contenedor">
            <?php
                // Mostrar la información de todos las peliculas en formato de tabla HTML
                echo "<table border='1'>";
                echo "<tr><th>Imagen</th><th>Titulo</th><th>Descripción</th></tr>";
                if($result)
                while ($row=$result->fetch_array()) {

                    echo "<tr>";
                    echo "<td>{$row['direccion_fotografia']}</td>";
                    echo "<td><a href='./reseñasYvaloraciones.php?titulo={$row['titulo']}'>{$row['titulo']}</a></td>";
                    echo "<td>{$row['descripcion']}</td>";
                    echo "</tr>";

                    //imagenpeli 
                    //desc
                    //a- href ='./reseñasYvaloraciones?='.pelicula  
                    
                }
                echo "</table>";
            ?>
        </div>
    </body>
</html>