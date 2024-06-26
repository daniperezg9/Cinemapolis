<?php 
namespace cinemapolis\src;
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
    <h1>Bienvenido al foro!</h1>
  EOS;
  if($result!=null){
    foreach($result as $row) {
      $idforo = $row->getIdForo();
      $contacto = $row->getContacto();
      $descripcion = $row->getDescripcion();
      $contenidoPrincipal .= <<< EOS
      <div id ="contenedorForo">
      <form action="foros.php" method="post" style="display: inline;">
      <p>Foro:</p>
          <input type="hidden" name="id_foro" value="$idforo">
          <button type="submit">$idforo</button>
      </form>
      <p>Descripción: $descripcion
      <p>Creador por: $contacto
      EOS;
      if(Admin::esAdmin($_SESSION) || $_SESSION["contacto"] == $row->getContacto()){ //Si eres admin o el dueño puedes editarlo
        $contenidoPrincipal .= <<< EOS
        <form action= "signupEditForo.php?foro={$idforo}&contacto={$contacto}" method="post" style="display: inline;">
        <p> Editar Foro:</p>
            <button type="submit">Editar Foro</button>
        </form>
        EOS;
      }
      if(Admin::esAdmin($_SESSION)){ //Si eres admin puedes borrarlo.
        $contenidoPrincipal .= <<< EOS
          <form action="borrarForo.php" method="post" style="display: inline;">
          <p> Deseas borrar este foro (NO HAY VUELTA ATRÁS):</p>
              <input type="hidden" name="id_foro" value="$idforo">
              <input type="hidden" name="contacto" value="$contacto">
              <button type="submit">Borrar Foro</button>
          </form>
        EOS;
      }
      $contenidoPrincipal .= <<< EOS
      </div>
      EOS;
    }
  }
  else {
    $contenidoPrincipal .= <<<EOS
    <p>No hay ningún foro creado.</p>
    EOS;
  }
  $contenidoPrincipal .= <<<EOS
  <p>Crea tu propio foro: <a href= 'signupForo.php'>Foro Nuevo </a></p>
  EOS;
}

require __DIR__.'/includes/vistas/plantillas/plantilla.php';