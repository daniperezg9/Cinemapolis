<?php
namespace cinemapolis;

require_once 'includes/config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (Usuario::get_esAdmin_usuario()) {
        $app = Aplicacion::getInstance();
        $conn = $app->getConexionBd();
        $tipo = $_POST['tipo'];
        $query = "";
                switch ($tipo) {
                    case 'evento':
                        $solicitud = Evento::borrarEvento($_POST['nombre_evento'], $_POST['creador_evento'], $_POST['fecha_evento']);
                        /*
                        $parametros = array($_POST['nombre_evento'], $_POST['creador_evento'], $_POST['fecha_evento']);
                        $query = "DELETE FROM eventos WHERE nombre_evento = ? AND creador_evento = ? AND fecha_evento = ?";
                        */
                        break;
                    case 'foro':
                        $solicitud = Foro::borraForo($_POST['id_foro'], $_POST['contacto']);
                        /*
                        $parametros = array($_POST['id_foro'], $_POST['contacto'], $_POST['fecha_envio']);
                        $query = "DELETE FROM foros WHERE id_foro = ? AND contacto= ? AND fecha_envio = ?";
                        */
                        break;
                    case 'reseña':
                        $solicitud= Resenyas::borrarResenya($_POST['contacto'], $_POST['pelicula']);
                        /*
                        $parametros = array($_POST['contacto'], $_POST['pelicula']);
                        $query = "DELETE FROM resenyas WHERE contacto = ? AND pelicula = ?";
                        */
                        break;
                    case 'valoraciones':
                        
                        $solicitud = Valoraciones::borrarValoracion($_POST['contacto'], $_POST['pelicula']);
                        /*
                        $parametros = array($_POST['contacto'], $_POST['pelicula']);
                        $query = "DELETE FROM valoraciones WHERE contacto = ? AND pelicula = ?";
                        */
                        break;
                    case 'peliculas':
                        $solicitud= Pelicula::borrarPelicula($_POST['titulo']);
                        /*
                        $parametros = array($_POST['titulo']);
                        $query = "DELETE FROM peliculas WHERE titulo = ?";
                        */
                        break;
                }
                /*
                $stmt = $conn->prepare($query);

                $tipos = str_repeat("s", count($parametros)); 
                $stmt->bind_param($tipos, ...$parametros);

                
                if ($stmt->execute()) {
                    echo "$tipo eliminado con éxito.";
                exit();
                }else {
                    echo "Error al eliminar el elemento: " . $conn->error;
                }
                $stmt->close();
                */
                header("Location:index.php");
    } 
    else {
        echo "No tienes permisos para realizar esta acción.";
        exit();
    }
} else {
    echo "Acción no permitida.";
    exit();
}
