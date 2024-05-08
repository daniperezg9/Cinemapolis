<?php
namespace cinemapolis\src;

class FormularioEditarMensaje extends Formulario{

    public function __construct(){
        parent::__construct('formeditarmsg', ['urlRedireccion' => 'listaForos.php', 'enctype' => 'multipart/form-data']);
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
            <legend>Edita mensaje existente</legend>
            <div>
                <label for="mensaje">Mensaje Editado</label>
                <input id="mensaje" type="text" name="mensaje" value="$mensaje" />
                <p>{$erroresCampos['mensaje']}</p>
            </div>
        <button type="submit" name="Enviar">Editar</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $mensaje = trim($datos['mensaje'] ?? '');
        $mensaje = filter_var($mensaje, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $mensaje || empty($mensaje)) {
            $this->errores['mensaje'] = 'El mensaje no puede estar vacío.';
        }

        if (count($this->errores) === 0) {

            Mensaje::modificarMensaje($mensaje, $_SESSION['msgEditFE']);

            unset($_SESSION['msgEditFE']);
        }
    }
}