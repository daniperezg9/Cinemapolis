<?php
namespace cinemapolis;
use SplFileInfo;
class FormularioAnyadirPelicula extends Formulario{

    public function __construct(){
        parent::__construct('formanyadirpeli', ['urlRedireccion' => 'listaPeliculas.php' , 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $archivo= $datos['archivo'] ?? '';
        $alt = $datos['alt'] ?? '';
        $titulo = $datos['titulo'] ?? '';
        $desc = $datos['desc'] ?? '';
        $fecha_estreno = $datos['fecha_estreno'] ?? '';
        $genero = $datos['genero'] ?? '';
        
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['archivo', 'alt','titulo', 'desc','fecha_estreno','genero'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Registra una nueva pelicula</legend>
            <div>
                <label for="archivo">Imagen de la película:</label>
                <input id="archivo" type="file" name="archivo" value="$archivo" />
                <p>{$erroresCampos['archivo']}
            </div>
            <div>
                <label for="alt">Descripcion de la imagen:</label>
                <input id="alt" type="text" name="alt" value="$alt" />
                <p>{$erroresCampos['alt']}
            </div>
            <div>
                <label for="titulo">Titulo de la pelicula:</label>
                <input id="titulo" type="text" name="titulo" value="$titulo" />
                <p>{$erroresCampos['titulo']}
            </div>
            <div>
                <label for="desc">Descripcion de la pelicula:</label>
                <input id="desc" type="text" name="desc" value="$desc" />
                <p>{$erroresCampos['desc']}
            </div>
            <div>
                <label for="fecha_estreno">Fecha de estreno de la pelicula:</label>
                <input id="fecha_estreno" type="date" name="fecha_estreno" value="$fecha_estreno" />
                <p>{$erroresCampos['fecha_estreno']}
            </div>
            <div>
                <label for="genero">Genero de la pelicula:</label>
                <input id="genero" type="text" name="genero" value="$genero" />
                <p>{$erroresCampos['genero']}
            </div>
        <fieldset>
        <button type="submit" name="Enviar">Añadir</button>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $archivo= $_FILES['archivo']['name']; //FALTA procesar que sea png y el tamaño
        $alt =      filter_var($datos['alt'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $titulo =   filter_var($datos['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $desc =     filter_var($datos['desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fecha_estreno = $datos['fecha_estreno'];
        $genero =   filter_var($datos['genero'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        if ( ! $archivo || empty($archivo) ) {
            $this->errores['archivo'] = 'La imagen no puede ser vacía.';
        }
        if ( ! $alt || empty($alt) ) {
            $this->errores['alt'] = 'La descripción de la imagen no puede ser vacía.';
        }
        if ( ! $titulo || empty($titulo) ) {
            $this->errores['titulo'] = 'El titulo no puede estar vacío.';
        }
        if ( ! $desc || empty($desc) ) {
            $this->errores['desc'] = 'La descripción de la pelicula no puede ser vacía.';
        }
        if ( ! $fecha_estreno || empty($fecha_estreno) ) {
            $this->errores['fecha_estreno'] = 'La fecha de estreno no puede estar vacía.';
        }
        if ( ! $genero || empty($genero) ) {
            $this->errores['genero'] = 'El genero de la pelicula no puede estar vacío.';
        }

        if (count($this->errores) === 0) {

            $peli = Pelicula::buscaPelicula($datos['titulo']);
            
            if($peli){
                $this->errores[] = "La pelicula ya esta registrada en la base de datos";
            }
            else{

                //$tamano = $_FILES['archivo']['size'];   //FALTA que funcione

                //$info=new SplFileInfo($archivo);
                //$tipo = $info->getExtension();
                
                $tipo = $_FILES['archivo']['type'];
                $tamano = $_FILES['archivo']['size'];
                $temp = $_FILES['archivo']['tmp_name'];
                
                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    $this->errores['archivo']='Error. La extensión o el tamaño de los archivos no es correcta.<br/>- Se permiten archivos .gif, .jpg, .jpeg, .png. y de 200 kb como máximo.';
                }
                else {
                    $creado=false;
                    
                                        //insertaPelicula($titulo,$descripcion,$alt,$fecha_estreno,$archivo,$temp,$genero)
                    if(!Pelicula::insertaPelicula($titulo,$desc,$alt,$fecha_estreno,$archivo,$temp,$genero)){
                        $this->errores[]='Faltan datos por rellenar o ya existe la pelicula';
                    }
                }
            }
        }
                
    }
    
}


?>