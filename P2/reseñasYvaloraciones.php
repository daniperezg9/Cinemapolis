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
        $tituloPeli=$conn->real_escape_string($_GET['titulo']);

        // Creamos la consulta
        $query = "SELECT pg.genero AS genero,p.fecha_estreno AS fecha_estreno FROM `peliculas` p join `genero_peliculas` pg ON p.titulo=pg.titulo WHERE p.titulo ='$tituloPeli'";
        // Realizamos la consulta
        $result = $conn->query($query);

        if($result){
          while($row = $result->fetch_array()){
            $generoPeli=$row['genero'];
            $fecha_estreno=$row['fecha_estreno'];
          }

        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <link rel="stylesheet" type="text/css" href="estilo.css">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Administrador</title>
</head>
<?php $_POST['pelicula']=$tituloPeli;?>
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
    <img src="./imgs/$tituloPeli" alt="peli" width="15%" height="15%">
    <p> Sinopsis </p>
  </div>
  <section id="app">
    <div class="container">
      <div class="row">
        <div class="col-6">
          <div class="comment">
            <?php
              $comments = getComments();
              foreach ($comments as $comment) {
                echo '<p><strong>' . $comment['user'] . ':</strong> ' . $comment['text'] . ' - Puntuación: ' . $comment['rating'] . '</p>';
              }
            ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          
          <form action="./agregaResenyas.php" method= "post">
            <input name= "resenya" class="input" placeholder="Escriba un comentario">
            <input type="hidden" name= "pelicula" value=<?=$tituloPeli?>>
            <button type="submit" class='primaryContained float-right'>Add Comment</button>
          </form>
        </div>
        <div class="col-6">
          <form action="./agregaValoraciones.php" method= "post">
            <input type="number" name="puntuacion" class="input" placeholder="Puntuación (1-100)" min="0" max="100">
            <input type="hidden" name= "pelicula" value=<?=$tituloPeli?>>
            <button type="submit1" class='primaryContained float-right'>Add Comment</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $newComment = array(
        'user' => 'Jorge',
        'text' => $_POST['resenya'],
        'rating' => $_POST['rating']
      );

      saveComment($newComment);
    }

    function getComments() {
      $commentsFile = 'comments.json';

      if (file_exists($commentsFile)) {
        $commentsData = file_get_contents($commentsFile);
        return json_decode($commentsData, true);
      } else {
        return array();
      }
    }

    function saveComment($comment) {
      $comments = getComments();
      $comments[] = $comment;
      $commentsFile = 'comments.json';
      file_put_contents($commentsFile, json_encode($comments, JSON_PRETTY_PRINT));
    }

    function calcularMedia() {
      $comments = getComments();

      if (count($comments) === 0) {
        return 0;
      }

      $sumaPuntuaciones = array_reduce($comments, function ($total, $comment) {
        return $total + $comment['rating'];
      }, 0);

      return number_format($sumaPuntuaciones / count($comments), 2);
    }
  ?>

</body>

</html>
