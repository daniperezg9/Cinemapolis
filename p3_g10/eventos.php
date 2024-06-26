<?php //TODO Comprobar si funciona con la base de datos
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
//Parametros de acceso de la base de datos
    
    //abrimos conexión 
    if(isset($_SESSION['login']) && $_SESSION['login']) {
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        if ($conn->connect_error) {
            die("La conexión ha fallado" . $conn->connect_error);
        }
        // Creamos la consulta
        $query = "SELECT * FROM eventos";
        // Realizamos la consulta
        $result = $conn->query($query);
    }


$tituloPagina = 'Pagina Principal Eventos';

    if (!isset($_SESSION['login'])) {
        $contenidoPrincipal = <<<EOS
        <h1 class = "advertencia">⚠️Advertencia⚠️</h1>
        <h2>Para acceder a los eventos es necesario haber iniciado sesión. <a href='login.php'>Login</a></h2>
        EOS;
    }
    else{
        if($result->num_rows > 0){
            while($row = $result->fetch_array()){
                $creador = $row['creador_evento'];
                $nombre = $row['nombre_evento'];
                $descripcion = $row['descripcion_evento'];
                $fecha = $row['fecha_evento'];
                $creacion = $row['fecha_creacion'];
                $contenidoPrincipal = <<< EOS
                    <h2>$nombre</h2>
                        <p>
                            <b>Descripcion: </b>$descripcion<br>
                            <b>Creador: </b>$creador<br>
                            <b>Fecha de inicio: </b>$fecha<br>
                            <b>Fecha de creacion: </b>$creacion<br>
                        </p>
                EOS;
                if(Admin::esAdmin($_SESSION)){ //Si eres admin puedes borrarlo.
                    $contenidoPrincipal .= <<< EOS
                    <p><a href='borrarEvento.php?nombre_evento={$row['nombre_evento']}&creador_evento={$row['creador_evento']}&fecha_evento={$row['fecha_evento']}'>Borrar Evento</a></p>
                    EOS;
                  }
            }
        }
        else
        {
            $contenidoPrincipal = <<<EOS
            <p>No hay ningún evento creado.</p>
            EOS;
        }
    }

    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
