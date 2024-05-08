<?php
namespace cinemapolis\src;

class FormularioEditarForo extends Formulario{

    public function __construct(){
        parent::__construct('formeditarforo', ['urlRedireccion' => 'listaForos.php', 'enctype' => 'multipart/form-data']);
    }

    

    protected function generaCamposFormulario(&$datos){

        $descripcion = $datos['descripcion'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['descripcion'],
                                                    $this->errores, 'span', array('class' => 'error'));
        
        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Edita foro existente</legend>
            <div>
                <label for="descripcion">Descripcion del foro</label>
                <input id="descripcion" type="text" name="descripcion" value="$descripcion" />
                <p>{$erroresCampos['descripcion']}</p>
            </div>
        <button type="submit" name="Enviar">Editar</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $foro = ($_GET['foro']);
        $con = ($_GET['contacto']);
        $this->errores = [];

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $descripcion || empty($descripcion)) {
            $this->errores['descripcion'] = 'La descripcion no puede estar vacía.';
        }

        if (count($this->errores) === 0) {

            Foro::modificarForo($foro,$con,$descripcion);

        }
    }
}


?>