<?php
namespace cinemapolis;
use SplFileInfo;

class FormularioModificarResenya extends Formulario{

    public function __construct(){
        parent::__construct('formmodificarresesenya', ['urlRedireccion' => 'listaPeliculas.php' , 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $titulo = $datos['titulo'] ?? '';
        $contacto = $datos['contacto'] ?? '';
        $contacto = $datos['mensaje'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo','mensaje','contacto'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Modifique su reseña</legend>
            <div>
                <label for="titulo">Modificar Reseña:</label>
                <input id="titulo" type="text" name="mensaje" value="$mensaje" />
                
            </div>
            <button type="submit" name="Enviar">Modificar reseña</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $mensaje =      filter_var($datos['mensaje'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $titulo =   filter_var($datos['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( !$mensaje || empty($mensaje) ) {
            $this->errores['mensaje'] = 'Tienes que añadir una reseña';
        }

        if (count($this->errores) === 0) {

            $peli = Resenya::buscaUsuarioRensenya($datos['titulo'],$datos['contacto']);
            
            if(!$peli){
                $this->errores[] = "Este usuario no ha realizado una reseña";
            }
            else{
                if(!Resenya::modificarResenyas($contacto,$titulo,$mensaje)){
                    $this->errores[]='Faltan datos por rellenar o ya se ha realizado una reseña sobre la pelicula';
                }
            }
        }
                
    }
    
}


?>