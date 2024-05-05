<?php
namespace cinemapolis;

class FormularioAnyadirMensaje extends Formulario{

    public function __construct(){
        parent::__construct('formañadirmsg', ['urlRedireccion' => 'foro.php']);
    }

    protected function generaCamposFormulario(&$datos){

        $id_foro = $datos['id_foro'] ?? '';
        $contacto = $datos['contacto'] ?? '';
        $mensaje = $datos['mensaje'] ?? '';
        $fecha_envio = $datos['fecha_envio'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['id_foro', 'contacto', 'mensaje', 'fecha_envio'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Añade un mensaje</legend>
            <div>
                <label for="mensaje">Mensaje:</label>
                <input id="mensaje" type="text" name="mensaje" value="$mensaje" />
                <p>{$erroresCampos['mensaje']}
            </div>
            <button type="submit" name="Enviar">Añadir</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $mensaje = trim($datos['mensaje'] ?? '');
        $mensaje = filter_var($mensaje, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $mensaje || empty($mensaje) ) {
            $this->errores['mensaje'] = 'El mensaje no puede estar vacío.';
        }

        if (count($this->errores) === 0) {
            $fecha_envio=date("Y-m-d H:i:s");
            Mensaje::añadirMensaje($_SESSION['foroMsg'], $_SESSION['contacto'],$mensaje,$fecha_envio);
            unset($_SESSION['foroMsg']);
        }
    }
}


?>