<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
  $app = Aplicacion::getInstance();
  $conn = $app->getConexionBd();
  if ($conn->connect_error) {
    die("La conexión ha fallado" . $conn->connect_error);
  }
  // Creamos la consulta
  $query = "SELECT * FROM lista_foros";
  // Realizamos la consulta
  $result = $conn->query($query);
}


$tituloPagina = 'Pagina Principal Foro';

if (!isset($_SESSION['login'])) {
  $contenidoPrincipal = <<<EOS
    <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
    <h2>Para acceder al foro es necesario haber iniciado sesión. <a href='login.php'>Login</a></h2>
  EOS;
}
else {
  $contenidoPrincipal = <<< EOS
    <h1>Bienvenido al foro: interactúa con quien quieras!</h1>
  EOS;
  if($result->num_rows!=0){
    while($row = $result->fetch_array()){
      $idforo = $row['id_foro'];
      $contacto = $row['contacto'];
      $descripcion = $row['descripcion'];
      $contenidoPrincipal .= <<< EOS
      <p>Foro: <a href='./foros.php?id_foro={$row["id_foro"]}'>$idforo</a>
      <p>Descripción: $descripcion
      <p>Creador por: $contacto
      EOS;
      if(Admin::esAdmin($_SESSION)){ //Si eres admin puedes borrarlo.
        $contenidoPrincipal .= <<< EOS
        <p> Deseas borrar este foro (no hay vuelta atrás): <a href='borraForo.php?id_foro={$idforo}&contacto={$contacto}'>Borrar Foro</a></p>
        EOS;
      }
      $contenidoPrincipal .= <<< EOS
      <p>------------------------------</p>
      EOS;
    }
  }
  else {
    $contenidoPrincipal .= <<<EOS
    <p>No hay ningún foro creado.</p>
    <p>--------------------------</p>
    EOS;
  }
  $contenidoPrincipal .= <<<EOS
  <p>Crea tu propio foro: <a href= 'signupForo.php'>Foro Nuevo </a></p>
  EOS;
  $result->free();
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';