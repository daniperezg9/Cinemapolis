<?php
namespace cinemapolis\src;

class FormularioModificarEvento extends Formulario{

    public function __construct(){
        parent::__construct('formmodevento', ['urlRedireccion' => 'eventos.php']);        	
    }

    protected function generaCamposFormulario(&$datos){

        $nombre_evento = $datos['nombre_evento'] ?? '';
        $descripcion_evento = $datos['descripcion_evento'] ?? '';
        $fecha_evento = $datos['fecha_evento'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre_evento', 'descripcion_evento', 'fecha_evento'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id=modificaEventoFieldset>
            <legend id=modificaEventoLegend>Modifica este evento:</legend>
            <div>
                <label for="nombre_evento">Nombre del evento:</label>
                <input id="nombre_evento" type="text" name="nombre_evento" value="$nombre_evento" />
                <p>{$erroresCampos['nombre_evento']}
            </div>
            <div>
                <label for="descripcion_evento">Descripcion del evento</label>
                <input id="descripcion_evento" type="text" name="descripcion_evento" value="$descripcion_evento" />
                <p>{$erroresCampos['descripcion_evento']}
            </div>      
            <div>
                <label for="fecha_evento">Fecha del evento</label>
                <input id="fecha_evento" type="date" name="fecha_evento" value="$fecha_evento" />
                <p>{$erroresCampos['fecha_evento']}
            </div>       
        <button type="submit" name="Enviar">Modificar Evento</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre_evento = trim($datos['nombre_evento'] ?? '');
        $nombre_evento = filter_var($nombre_evento, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre_evento || empty($nombre_evento) ) {
            $this->errores['nombre_evento'] = 'El nombre del evento no puede estar vacío.';
        }

        $descripcion_evento = trim($datos['descripcion_evento'] ?? '');
        $descripcion_evento = filter_var($descripcion_evento, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $descripcion_evento || empty($descripcion_evento)) {
            $this->errores['descripcion_evento'] = 'La descripcion no puede estar vacía.';
        }

        $fecha_evento = trim($datos['fecha_evento'] ?? '');
        $fecha_evento = filter_var($fecha_evento, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $fecha_evento || empty($fecha_evento)) {
            $this->errores['fecha_evento'] = 'La fecha no puede estar vacía.';
        }

        if (count($this->errores) === 0) {
            $fecha_creacion = date("Y-m-d");
            $evento = Evento::modificarEvento($nombre_evento,$descripcion_evento,$fecha_evento,$_SESSION['nEventoEdit'],$_SESSION['fEventoEdit'],$_SESSION['cEventoEdit']);
            unset($_SESSION['nEventoEdit']);
            unset($_SESSION['fEventoEdit']);
            unset($_SESSION['cEventoEdit']);
        }
    }
}


?>