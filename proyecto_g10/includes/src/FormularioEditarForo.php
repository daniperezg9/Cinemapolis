<?php
namespace cinemapolis\src;

class FormularioEditarForo extends Formulario{

    public function __construct(){
        parent::__construct('formeditarforo', ['urlRedireccion' => 'listaForos.php', 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $id_foro = $datos['id_foro'] ?? '';
        $contacto = $datos['contacto'] ?? '';
        $descripcion = $datos['descripcion'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['id_foro', 'contacto', 'descripcion'],
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
        $this->errores = [];

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $descripcion || empty($descripcion)) {
            $this->errores['descripcion'] = 'La descripcion no puede estar vacía.';
        }

        if (count($this->errores) === 0) {

            Foro::modificarForo($_SESSION['foroEditId'],$_SESSION['foroEditCon'],$descripcion);

            unset($_SESSION['foroEditId']);
            unset($_SESSION['foroEditCon']);
            unset($_SESSION['foroEditDes']);
        }
    }
}


?>