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
$fecha_actual = date("Y-m-d");
$contenidoPrincipal = '';
    if (!isset($_SESSION['login'])) {
        $contenidoPrincipal .= <<<EOS
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
                $contenidoPrincipal .= <<< EOS
                    <div id='contenedorEvento'>
                        <h2>$nombre</h2>
                        <p>
                            <strong>Descripcion: </strong>$descripcion<br>
                            <strong>Creador: </strong>$creador<br>
                            <strong>Fecha de inicio: </strong>$fecha<br>
                            <strong>Fecha de creacion: </strong>$creacion<br>
                        </p>
                EOS;
                if(Admin::esAdmin($_SESSION) || $_SESSION["contacto"] == $row["creador_evento"]){ //Si eres admin puedes borrarlo.
                    $contenidoPrincipal .= <<<EOS
                        <div id ='borrarEventoBoton'>
                            <form action='borrarEvento.php' method='post'>
                                <input type='hidden' name='nombre_evento' value='{$row['nombre_evento']}'>
                                <input type='hidden' name='creador_evento' value='{$row['creador_evento']}'>
                                <input type='hidden' name='fecha_evento' value='{$row['fecha_evento']}'>
                                <input type='submit' value='Borrar Evento'>
                            </form>
                        </div>
                    EOS;
                }
                $contenidoPrincipal .= "</div>"; // Cierra el contenedorEvento aquí
        
        
                if(Admin::esAdmin($_SESSION) || $_SESSION["contacto"] == $row["creador_evento"]){ //Si eres admin puedes borrarlo.
                    $contenidoPrincipal .= <<<EOS
                    <form action="./editaEvento.php" method="post">
                        <fieldset id=modificaEventoFieldset>
                            <legend id = "modificaEventoLegend">Modifica este evento</legend>
                            Nombre del evento:<br>
                            <input type="text" name="nombre_evento"><br>
                        
                            Descripción básica del evento:<br>
                            <input type="text" name="descripcion_evento"><br>
                        
                            Fecha del evento:<br>
                            <input type="date" name="fecha_evento"><br>
                            <input type="submit" name="Modificar Evento" value= "Modifcar Evento">
                            <input type='hidden' name='nombre_evento_old' value='{$row['nombre_evento']}'>
                            <input type='hidden' name='creador_evento_old' value='{$row['creador_evento']}'>
                            <input type='hidden' name='fecha_evento_old' value='{$row['fecha_evento']}'>
                            <input type='hidden' name='fecha_actual' value='$fecha_actual'>
                        </fieldset>
                </form>
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
        

        $contenidoPrincipal .= <<<EOS
                <form action="./agregaEvento.php" method="post">
                    <fieldset id=agregaEventoFieldset>
                            <legend id ="agregaEventoLegend">Añade un nuevo evento</legend>
                            Nombre del evento:<br>
                            <input type="text" name="nombre_evento"><br>
                            Descripción básica del evento:<br>
                            <input type="text" name="descripcion_evento"><br>
                            Fecha del evento:<br>
                            <input type="date" name="fecha_evento"><br>
                            <input type='hidden' name='fecha_actual' value='$fecha_actual'>
                            <input type='hidden' name='creador_evento' value="{$_SESSION['contacto']}">
                            <input type="submit" name="Añadir Evento" value="Añadir evento">
                        </fieldset>
                </form>
        EOS;



    }

    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
