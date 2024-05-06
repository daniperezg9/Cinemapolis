<?php
namespace cinemapolis;
use SplFileInfo;

class FormularioAnyadirValoracion extends Formulario{

    public function __construct(){
        parent::__construct('formanyadirvaloracion', ['urlRedireccion' => 'listaPeliculas.php' , 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $titulo = $datos['titulo'] ?? '';
        $puntuacion = $datos['puntuacion'] ?? '';
        $contacto = $datos['contacto'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo','puntuacion','contacto'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Registra una nueva valoración</legend>
            <div>
                <label for="titulo">Reseña:</label>
                <input id="titulo" type="text" name="puntuacion" value="$puntuacion" />
                
            </div>
            <button type="submit" name="Enviar">Añadir Valoración</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $puntuacion =  filter_var($datos['puntuacion'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $titulo =   filter_var($datos['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( !$puntuacion || empty($puntuacion) ) {
            $this->errores['puntuacion'] = 'Tienes que añadir una valoración';
        }

        if (count($this->errores) === 0) {

            $peli = Valoracion::buscaUsuarioValoracion($datos['titulo'],$datos['contacto']);
            
            if($peli){
                $this->errores[] = "Este usuario ya ha realizado una valoración";
            }
            else{
                if(!Valoracion::añadirReseñas($titulo,$contacto,$puntuacion)){
                    $this->errores[]='Faltan datos por rellenar o ya se ha valorado la pelicula';
                }
            }
        }
                
    }
    
}


?>