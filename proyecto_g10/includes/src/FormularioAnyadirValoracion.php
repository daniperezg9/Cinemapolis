<?php
namespace cinemapolis\src;
use SplFileInfo;

class FormularioAnyadirValoracion extends Formulario{

    public function __construct(){
        $titulo = $_GET['titulo'] ?? '';
        $url_destino = './resenyasYvaloraciones.php?titulo=' . urlencode($titulo);
        parent::__construct('formanyadirvaloracion', ['urlRedireccion' => $url_destino, 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $titulo = $_GET['titulo'] ?? '';
        $puntuacion = $datos['puntuacion'] ?? 1;
        $contacto = $_SESSION['contacto'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo','puntuacion','contacto'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Registra una nueva valoración</legend>
            <div>
            <label for="puntuacion">Valoración (1-10):</label>
            <input required id="puntuacion" type="number" name="puntuacion" min="1" max="10" required value="$puntuacion" />
                <p>{$erroresCampos['puntuacion']}</p>
                <input type="hidden" name="contacto" value="$contacto">
                <p>{$erroresCampos['contacto']}</p>
                <input type="hidden" name="titulo" value="$titulo">
                <p>{$erroresCampos['titulo']}</p>
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
        $contacto =   filter_var($datos['contacto'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( !$puntuacion || empty($puntuacion) ) {
            $this->errores['puntuacion'] = 'Tienes que añadir una valoración';
        }

        if (count($this->errores) === 0) {

            $peli = Valoracion::buscaUsuarioValoracion($datos['titulo'],$datos['contacto']);
            
            if($peli){
                $this->errores[] = "Este usuario ya ha realizado una valoración";
            }
            else{
                if(!Valoracion::añadirValoracion($titulo,$contacto,$puntuacion)){
                    $this->errores[]='Faltan datos por rellenar o ya se ha valorado la pelicula';
                }else{
                    $_SESSION['valoracion_realizadas'][$titulo][$contacto] = true;
                }
            }
        }
                
    }
    
}


?>