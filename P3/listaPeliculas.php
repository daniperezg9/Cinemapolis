<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

//Definicion de constantes
//Parametros de acceso de la base de datos
//abrimos conexión 
if(isset($_SESSION['login']) && $_SESSION['login']) {
    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if ($conn->connect_error) {
        die("La conexión ha fallado" . $conn->connect_error);
    }
    
    // Creamos la consulta
    $query = "SELECT * FROM peliculas";
    // Realizamos la consulta
    $result = $conn->query($query);

    // Preparamos el contenido principal
    $contenidoPrincipal = <<<EOS
    <div id="contenedor">
        <table border='1'>
            <tr><th>Imagen</th><th>Título</th><th>Descripción</th></tr>
    EOS;

    if($result)
    while ($row=$result->fetch_array()) {
        $img=$row['direccion_fotografia'];
        $alt=$row['alt'];
        $contenidoPrincipal .= <<<EOS
            <tr>
                <td><img src='$img' alt='$alt' width='100' height='120'/></td>
                <td><a href='./reseñasYvaloraciones.php?titulo={$row['titulo']}'>{$row['titulo']}</a></td>
                <td>{$row['descripcion']}</td>
            </tr>
    EOS;
    }
    $contenidoPrincipal .= <<<EOS
        </table>
    </div>
    EOS;
}
else{ //Sino mostramos un error por no haber iniciado sesión

    $contenidoPrincipal = <<<EOS
    <h2 class = "errorInicioSesion">[⚠️ERROR⚠️] Para acceder a esta página web es necesario haber iniciado sesión.</h2>
    EOS;
}

$tituloPagina = 'Lista de películas';

require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
