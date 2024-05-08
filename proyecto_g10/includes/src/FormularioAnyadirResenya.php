<?php
namespace cinemapolis\src;
use SplFileInfo;

class FormularioAnyadirResenya extends Formulario{

    public function __construct(){
        $titulo = $_GET['titulo'] ?? '';
        $url_destino = './resenyasYvaloraciones.php?titulo=' . urlencode($titulo);
        parent::__construct('formanyadirresesenya', ['urlRedireccion' => $url_destino, 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $titulo = $_GET['titulo'] ?? '';
        $mensaje = $datos['mensaje'] ?? '';
        $contacto = $_SESSION['contacto'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['titulo','mensaje','contacto'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Registra una nueva reseña</legend>
            <div>
                <label for="titulo">Reseña:</label>
                <input required id="titulo" type="text" name="mensaje" value="$mensaje" />
                <p>{$erroresCampos['mensaje']}</p>
                <input type="hidden" name="contacto" value="$contacto">
                <p>{$erroresCampos['contacto']}</p>
                <input type="hidden" name="titulo" value="$titulo">
                <p>{$erroresCampos['titulo']}</p>
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
        $contacto =   filter_var($datos['contacto'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if ( !$mensaje || empty($mensaje) ) {
            $this->errores['mensaje'] = 'Tienes que añadir una reseña';
        }

        if (count($this->errores) === 0) {

            $peli = Resenyas::buscaUsuarioRensenya($datos['titulo'],$datos['contacto']);
            
            if($peli){
                $this->errores[] = "Este usuario ya ha realizado una reseña";
            }
            else{
                if(!Resenyas::añadirResenya($titulo,$contacto,$mensaje)){
                    $this->errores[]='Faltan datos por rellenar o ya se ha realizado una reseña sobre la pelicula';
                }else{
                    $_SESSION['reseñas_realizadas'][$titulo][$contacto] = true;
                }
            }
        }           
    }
}


?>