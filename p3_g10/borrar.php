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
                        break;
                    case 'foro':
                        $solicitud = Foro::borraForo($_POST['id_foro'], $_POST['contacto']);
                        break;
                    case 'reseña':
                        $solicitud= Resenyas::borrarResenya($_POST['contacto'], $_POST['pelicula']);
                        break;
                    case 'valoraciones':
                        $solicitud = Valoraciones::borrarValoracion($_POST['contacto'], $_POST['pelicula']);
                        break;
                    case 'peliculas':
                        $solicitud= Pelicula::borrarPelicula($_POST['titulo']);
                        break;
                }
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
