<?php 
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
if(isset($_SESSION['login']) && $_SESSION['login']) {
  $result = Mensaje::listaMensajes();
}


$tituloPagina = 'Foros';
$contenidoPrincipal = <<<EOS
  <table id="tablaForos">
  <tr><th>Mensaje</th><th>Usuario</th><th>Fecha Envío</th><th> </th><th> </th></tr>
EOS;
  if($result!=null){
    foreach($result as $row) {
      $con = $row->getContacto();
      $fe = $row->getFE();
      $contenidoPrincipal .= <<<EOS
        <tr>
        <td>{$row->getMensaje()}</td>
        <td>{$row->getContacto()}</td>
        <td>{$row->getFE()}</td>
      EOS;
        if($row->getContacto() == $_SESSION['contacto'] || $_SESSION['admin']=='1'){
        $_SESSION['msgEditFE'] = $row->getFE();
        $contenidoPrincipal .= <<<EOS
          <td>
          <form action="signupMensajeEdit.php" method="post" style="display: inline;">
            <button type="submit">Editar</button>
          </form>
          </td>
        EOS;
        }
        else{
        $contenidoPrincipal .= <<<EOS
          <td> </td>
        EOS;
        }
        if($row->getContacto() == $_SESSION['contacto'] || $_SESSION['admin']=='1'){  //Si creas el foro o tienes poderes de administración, puedes borar y editar los mensajes dentro de los mismos
          $contenidoPrincipal .= <<<EOS
          <td>
          <form action="borraMensaje.php" method="post" style="display: inline;">
              <input type="hidden" name="fecha_envio" value="$fe">
              <input type="hidden" name="contacto" value="$con">
              <button type="submit">Borrar</button>
          </form>
          </td>
          EOS;
        }
        else{
        $contenidoPrincipal .= <<<EOS
          <td> </td>
         EOS;
        }
        $contenidoPrincipal .= <<<EOS
        </tr> 
        EOS;
    }
  }
  else{
  $contenidoPrincipal .= <<<EOS
    <p> No hay ningún mensaje en este foro </p>
  EOS;
  }
  $_SESSION['foroMsg'] = $_POST['id_foro'];
  $contenidoPrincipal .= <<<EOS
  </table>
  <form action="signupMensaje.php" method="post" style="display: inline;">
    <p>Añadir mensaje al foro:
    <button type="submit">Mensaje Nuevo</button>
  </form>
  EOS;

  require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>