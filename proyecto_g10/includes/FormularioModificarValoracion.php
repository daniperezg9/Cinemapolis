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
        $contacto = $datos['puntuacion'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo','puntuacion','contacto'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Modifique su valoracion</legend>
            <div>
                <label for="titulo">Modificar valoracion:</label>
                <input id="titulo" type="text" name="puntuacion" value="$puntuacion" />
                
            </div>
            <button type="submit" name="Enviar">Modificar valoracion</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $puntuacion =      filter_var($datos['puntuacion'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $titulo =   filter_var($datos['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( !$puntuacion || empty($puntuacion) ) {
            $this->errores['puntuacion'] = 'Tienes que añadir una valoracion';
        }

        if (count($this->errores) === 0) {

            $peli = Valoracion::buscaUsuarioValoracion($datos['titulo'],$datos['contacto']);
            
            if(!$peli){
                $this->errores[] = "Este usuario no ha realizado una valoracion";
            }
            else{
                if(!Resenya::modificarResenyas($contacto,$titulo,$puntuacion)){
                    $this->errores[]='Faltan datos por rellenar o ya se ha realizado una valoracion sobre la pelicula';
                }
            }
        }
                
    }
    
}


?>