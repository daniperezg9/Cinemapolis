<?php //TODO Comprobar si funciona con la base de datos
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';

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
        $result=Evento::listaEventos();
        if($result!=null){
            foreach($result as $row) {
                $creador = $row->getCE();
                $nombre = $row->getNE();
                $descripcion = $row->getDE();
                $fecha = $row->getFE();
                $creacion = $row->getFC();
                $contenidoPrincipal .= <<< EOS
                    <div id='contenedorEvento'>
                        <h2>$nombre</h2>
                        <p>
                            <strong>Descripcion: </strong>$descripcion<br>
                            <strong>Creador: </strong>$creador<br>
                            <strong>Fecha de inicio: </strong>$fecha<br>
                            <strong>Fecha de creacion del evento: </strong>$creacion<br>
                        </p>
                EOS;
                if(Admin::esAdmin($_SESSION)){ 
                    $contenidoPrincipal .= <<<EOS
                        <div id ='borrarEventoBoton'>
                            <form action='borrarEvento.php' method='post'>
                                <input type='hidden' name='nombre_evento' value='{$nombre}'>
                                <input type='hidden' name='creador_evento' value='{$creador}'>
                                <input type='hidden' name='fecha_evento' value='{$fecha}'>
                                <input type='submit' value='Borrar Evento'>
                            </form>
                        </div>
                    EOS;
                }
                if(Admin::esAdmin($_SESSION)){ 
                    $contenidoPrincipal .= <<<EOS
                    <div id ='ModificarEventoBoton'>
                        <form action="./modificaEvento.php?oldn={$nombre}&oldc={$creador}&oldf={$fecha}" method="post">
                            <input type='submit' value='Modifica Evento'>                            
                        </form>
                    </div>
                    EOS;
                }
                $contenidoPrincipal .= "</div>";
            }
        }
        else
        {
            $contenidoPrincipal = <<<EOS
            <p>No hay ningún evento creado.</p>
            EOS;
        }
        
        if(Admin::esAdmin($_SESSION)){

            $formReg = new FormularioAnyadirEvento();
            $htmlForm = $formReg->gestiona();
            
            $contenidoPrincipal .= <<<EOS
                $htmlForm
            EOS;
        }
    }

    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>
