<?php //TODO Comprobar si funciona correctamente
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos

//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if ($conn->connect_error) {
        die("La conexión ha fallado" . $conn->connect_error);
    }
    $tituloPeli = $conn->real_escape_string($_GET['titulo']);

    // Consulta para obtener el género y la fecha de estreno de la película
    $query = "SELECT pg.genero AS genero, p.fecha_estreno AS fecha_estreno , p.direccion_fotografia AS dir , p.alt AS alt , p.descripcion AS descr FROM `peliculas` p JOIN `genero_peliculas` pg ON p.titulo = pg.titulo WHERE p.titulo ='$tituloPeli'";
    // Realizamos la consulta
    $result = $conn->query($query);

    if($result){
        while($row = $result->fetch_array()){
            $generoPeli = $row['genero'];
            $fecha_estreno = $row['fecha_estreno'];
            $dir= $row['dir'];
            $alt=$row['alt'];
            $descr=$row['descr'];

        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Reseñas y valoraciones</title>
</head>
<?php $_POST['pelicula']=$tituloPeli;?>
<?php require "./includes/vistas/comun/cabecera.php";?>
<body>

<div id="Titulo">
    <?php echo"
    <h1>$tituloPeli</h1>
    <ul>
      <li> $generoPeli </li>
      <li> $fecha_estreno </li>
      <!-- <li> Media de Puntuación: echo calcularMedia(); </li>-->
    </ul>"
    ?>
</div>
<div id="Imagen">
    <?php echo" <img src='$dir' alt='$alt' width='300' height='360'/>"; ?>
    <p> Sinopsis </p>
    <?php echo" <p>$descr</p>"; ?>
</div>
<section id="app">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="comment">
                    <?php
                    // Consulta para obtener las reseñas de la película desde la base de datos
                    $query_resenas = "SELECT contacto, mensaje FROM resenyas WHERE pelicula = ?";
                    $stmt_resenas = $conn->prepare($query_resenas);
                    $stmt_resenas->bind_param("s", $tituloPeli);
                    $stmt_resenas->execute();
                    $result_resenas = $stmt_resenas->get_result();

                    // Mostrar las reseñas
                    while($row_resenas = $result_resenas->fetch_assoc()) {
                        echo '<p><strong>' . $row_resenas['contacto'] . ':</strong> ' . $row_resenas['mensaje'] . '</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-6">
                <div class="rating">
                    <?php
                    // Consulta para obtener las valoraciones de la película desde la base de datos
                    $query_valoraciones = "SELECT puntuacion FROM valoraciones WHERE pelicula = ?";
                    $stmt_valoraciones = $conn->prepare($query_valoraciones);
                    $stmt_valoraciones->bind_param("s", $tituloPeli);
                    $stmt_valoraciones->execute();
                    $result_valoraciones = $stmt_valoraciones->get_result();

                    // Calcular el promedio de las valoraciones
                    $total_valoraciones = 0;
                    $num_valoraciones = $result_valoraciones->num_rows;
                    while($row_valoraciones = $result_valoraciones->fetch_assoc()) {
                        $total_valoraciones += $row_valoraciones['puntuacion'];
                    }
                    if ($num_valoraciones > 0) {
                        $promedio_valoraciones = $total_valoraciones / $num_valoraciones;
                        echo "<p><strong>Puntuación promedio:</strong> " . number_format($promedio_valoraciones, 2) . "</p>";
                    } else {
                        echo "<p>No hay valoraciones para esta película.</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <form action="./agregaResenyas.php" method= "post">
                    <input name= "resenya" class="input" placeholder="Escriba un comentario">
                    <input type="hidden" name= "pelicula" value="<?php echo $tituloPeli; ?>">
                    <button type="submit" class='primaryContained float-right'>Add Comment</button>
                </form>
            </div>
            <div class="col-6">
                <form action="./agregaValoraciones.php" method= "post">
                    <input type="number" name="puntuacion" class="input" placeholder="Puntuación (1-100)" min="0" max="100">
                    <input type="hidden" name= "pelicula" value="<?php echo $tituloPeli; ?>">
                    <button type="submit" class='primaryContained float-right'>Add Rating</button>
                </form>
            </div>
        </div>
    </div>
</section>

</body>

</html>
