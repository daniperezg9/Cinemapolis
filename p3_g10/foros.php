<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
if(isset($_SESSION['login']) && $_SESSION['login']) {
  $app = Aplicacion::getInstance();
  $conn = $app->getConexionBd();
    if ($conn->connect_error) {
        die("La conexión ha fallado" . $conn->connect_error);
    }
  $idforo=$conn->real_escape_string($_GET['id_foro']);
  // Creamos la consulta
  $query = "SELECT f.contacto AS contacto , f.fecha_envio AS fecha_envio ,f.mensaje AS mensaje FROM `foro` f join `lista_foros` lf ON f.id_foro=lf.id_foro WHERE lf.id_foro ='$idforo'";
  // Realizamos la consulta
  $result = $conn->query($query);
}


$tituloPagina = 'Foros';
$contenidoPrincipal = <<<EOS
  <table border='3'>
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
        $contenidoPrincipal .= <<<EOS
          <td><a href='signupMensajeEdit.php?fecha_envio={$row['fecha_envio']}'>Editar</a></td>
        EOS;
        }
        else{
        $contenidoPrincipal .= <<<EOS
          <td>No puedes editar</td>
        EOS;
        }
        if($row['contacto'] == $_SESSION['contacto'] || $_SESSION['admin']=='1'){  //Si creas el foro o tienes poderes de administración, puedes borar y editar los mensajes dentro de los mismos
          $contenidoPrincipal .= <<<EOS
           <td><a href='borraMensaje.php?fecha_envio={$row['fecha_envio']}&contacto={$row['contacto']}'>Borrar</a></td>
          EOS;
        }
        else{
        $contenidoPrincipal .= <<<EOS
          <td>No puedes borrar</td>
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
  $contenidoPrincipal .= <<<EOS
  </table>
  <p>Añadir mensaje al foro: <a href='./signupMensaje.php?id_foro=$idforo'>Mensaje nuevo</a></p>
  EOS;

  require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>