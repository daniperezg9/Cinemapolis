<?php
namespace cinemapolis;
use SplFileInfo;

class FormularioAnyadirResenya extends Formulario{

    public function __construct(){
        parent::__construct('formanyadirresesenya', ['urlRedireccion' => 'listaPeliculas.php' , 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $titulo = $datos['titulo'] ?? '';
        $mensaje = $datos['mensaje'] ?? '';
        $contacto = $datos['contacto'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo','mensaje','contacto'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Registra una nueva reseña</legend>
            <div>
                <label for="titulo">Reseña:</label>
                <input id="titulo" type="text" name="mensaje" value="$mensaje" />
                
            </div>
            <button type="submit" name="Enviar">Añadir reseña</button>
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
            
            if($peli){
                $this->errores[] = "Este usuario ya ha realizado una reseña";
            }
            else{
                if(!Resenya::añadirReseñas($titulo,$contacto,$mensaje)){
                    $this->errores[]='Faltan datos por rellenar o ya se ha realizado una reseña sobre la pelicula';
                }
            }
        }           
    }
}


?>