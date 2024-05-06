<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
if(isset($_SESSION['login']) && $_SESSION['login']) {
  $result = Mensaje::listaMensajes();
}


$tituloPagina = 'Foros';
$contenidoPrincipal = <<<EOS
  <table id="tablaForos">
  <tr><th>Usuario</th><th>Mensaje</th><th>Fecha Envío</th><th>Editar Mensaje</th><th>Borrar Mensaje</th></tr>
EOS;
  if($result->num_rows!=0){
    while ($row=$result->fetch_array()) {
      $contenidoPrincipal .= <<<EOS
        <tr>
        <td>{$row['contacto']}</td>
        <td>{$row['mensaje']}</td>
        <td>{$row['fecha_envio']}</td>
      EOS;
        if($row['contacto'] == $_SESSION['contacto'] || $_SESSION['admin']=='1'){
        $_SESSION['msgEditFE'] = $row['fecha_envio'];
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
        if($row['contacto'] == $_SESSION['contacto'] || $_SESSION['admin']=='1'){  //Si creas el foro o tienes poderes de administración, puedes borar y editar los mensajes dentro de los mismos
          $contenidoPrincipal .= <<<EOS
          <td>
          <form action="borraMensaje.php" method="post" style="display: inline;">
              <input type="hidden" name="fecha_envio" value="$row[fecha_envio]">
              <input type="hidden" name="contacto" value="$row[contacto]">
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
  $result->free();
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