<?php
namespace cinemapolis;

class FormularioAñadirForo extends Formulario{

    public function __construct(){
        parent::__construct('formañadirforo', ['urlRedireccion' => 'foro.php']);
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
            <legend>Crea un nuevo foro</legend>
            <div>
                <label for="id_foro">Nombre del foro:</label>
                <input id="id_foro" type="text" name="id_foro" value="$id_foro" />
                <p>{$erroresCampos['id_foro']}
            </div>
            <div>
                <label for="descripcion">Descripcion del foro</label>
                <input id="descripcion" type="text" name="descripcion" value="$descripcion" />
                <p>{$erroresCampos['descripcion']}
            </div>        
        <button type="submit" name="Enviar">Añadir</button>
        <fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $id_foro = trim($datos['id_foro'] ?? '');
        $id_foro = filter_var($id_foro, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $id_foro || empty($id_foro) ) {
            $this->errores['id_foro'] = 'El nombre no puede estar vacío.';
        }

        $descripcion = trim($datos['descripcion'] ?? '');
        $descripcion = filter_var($descripcion, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $descripcion || empty($descripcion)) {
            $this->errores['descripcion'] = 'La descripcion no puede estar vacía.';
        }

        if (count($this->errores) === 0) {

            $foro = Foro::mismoForo($id_foro, $_SESSION['contacto']);
            
            if($foro){
                $this->errores[] = "El foro ya esta registrada en la base de datos";
            }
            else{
                if (!Foro::añadirForo($id_foro, $_SESSION['contacto'], $descripcion)){
                    $this->errores[] = "El foro no ha podido ser insertada en la base de datos";
                }
            }
                
        }
    }
}


?>