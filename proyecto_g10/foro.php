<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
  $result=Foro::listaForo();
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
      <div id ="contenedorForo">
      <form action="foros.php" method="post" style="display: inline;">
      <p> Foro:
          <input type="hidden" name="id_foro" value="$idforo">
          <button type="submit">$idforo</button>
      </form>
      <p>Descripción: $descripcion
      <p>Creador por: $contacto
      EOS;
      if(Admin::esAdmin($_SESSION) || $_SESSION["contacto"] == $row["contacto"]){ //Si eres admin o el dueño puedes editarlo
        $_SESSION['foroEditId'] = $idforo;
        $_SESSION['foroEditCon'] = $contacto;
        $_SESSION['foroEditDes'] = $descripcion;
        $contenidoPrincipal .= <<< EOS
        <form action="signupEditForo.php" method="post" style="display: inline;">
        <p> Editar Foro:
            <button type="submit">Editar Foro</button>
        </form>
        EOS;
      }
      if(Admin::esAdmin($_SESSION)){ //Si eres admin puedes borrarlo.
        $contenidoPrincipal .= <<< EOS
          <form action="borrarForo.php" method="post" style="display: inline;">
          <p> Deseas borrar este foro (NO HAY VUELTA ATRÁS):
              <input type="hidden" name="id_foro" value="$idforo">
              <input type="hidden" name="contacto" value="$contacto">
              <button type="submit">Borrar Foro</button>
          </form>
        EOS;
      }
      $contenidoPrincipal .= <<< EOS
      </div>
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