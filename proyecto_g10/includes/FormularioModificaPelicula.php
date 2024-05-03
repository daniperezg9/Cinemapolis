<?php
namespace cinemapolis;
use SplFileInfo;
class FormularioModificaPelicula extends Formulario{

    public function __construct(){
        parent::__construct('formmodifpeli', ['urlRedireccion' => 'listaPeliculas.php' , 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){
        
        $archivo= $datos['archivo'] ?? '';
        $alt = $datos['alt'] ?? '';
        $titulo = $datos['titulo'] ?? '';
        $tituloprem =$_GET['titulo']??'';
        $desc = $datos['desc'] ?? '';
        $fecha_estreno = $datos['fecha_estreno'] ?? '';
        $genero = $datos['genero'] ?? '';
        
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['archivo', 'alt','titulo', 'desc','fecha_estreno','genero','tituloprem'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Modifica la pelicula:$tituloprem.</legend>
            <div>
            <p>Modifica solo los campos que necesites, los demas se rellenarán automaticamente al pulsar el boton modificar</p>
            </div>
            <div>    
                <p>{$erroresCampos['tituloprem']}</p>
                <input id="tituloprem" type="hidden" name= "tituloprem" value="$tituloprem"/>
            </div>
            <div>
                <label for="archivo">Imagen de la película:</label>
                <input id="archivo" type="file" name="archivo" value="$archivo" />
                <p>{$erroresCampos['archivo']}</p>
            </div>
            <div>
                <label for="alt">Descripcion de la imagen:</label>
                <input id="alt" type="text" name="alt" value="$alt" />
                <p>{$erroresCampos['alt']}</p>
            </div>
            <div>
                <label for="titulo">Titulo de la pelicula:</label>
                <input id="titulo" type="text" name="titulo" value="$titulo" />
                <p>{$erroresCampos['titulo']}</p>
            </div>
            <div>
                <label for="desc">Descripcion de la pelicula:</label>
                <input id="desc" type="text" name="desc" value="$desc" />
                <p>{$erroresCampos['desc']}</p>
            </div>
            <div>
                <label for="fecha_estreno">Fecha de estreno de la pelicula:</label>
                <input id="fecha_estreno" type="date" name="fecha_estreno" value="$fecha_estreno" />
                <p>{$erroresCampos['fecha_estreno']}</p>
            </div>
            <div>
                <label for="genero">Genero de la pelicula:</label>
                <input id="genero" type="text" name="genero" value="$genero" />
                <p>{$erroresCampos['genero']}</p>
            </div>

            <button type="submit" name="Enviar">Modificar</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $peli = Pelicula::buscaPelicula($datos['tituloprem']);
        $archivo=   $_FILES['archivo']['name']; 
        
        $alt =      filter_var($datos['alt'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $titulo =   filter_var($datos['titulo'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $desc =     filter_var($datos['desc'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $fecha_estreno = $datos['fecha_estreno'];
        $genero =   filter_var($datos['genero'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if(!$peli){
            $this->errores['tituloprem'] = "La pelicula no esta registrada en la base de datos por lo que no se puede modificar.";
        }
        if ( ! $archivo || empty($archivo)  ) {

            //$archivo = $_FILES($peli['direccion_fotografia']);
            $archivo = file($peli['direccion_fotografia']);
            $tipo = mime_content_type($peli['direccion_fotografia']);
            $tamano = filesize($peli['direccion_fotografia']);
            $temp = $peli['direccion_fotografia'];
            
        }
        else{

            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            
            if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
                $this->errores['archivo']='Error. La extensión o el tamaño de los archivos no es correcta.<br/>- Se permiten archivos .gif, .jpg, .jpeg, .png. y de 200 kb como máximo.';
            }
        }
        
        if ( ! $alt || empty($alt) ) {
            $alt= $peli['alt'];
        }
        if ( ! $titulo || empty($titulo) ) {
            $titulo=$datos['tituloprem'];
        }
        if ( ! $desc || empty($desc) ) {
            $desc= $peli['descripcion'];
        }
        if ( ! $fecha_estreno || empty($fecha_estreno) ) {
            $fecha_estreno=$peli['fecha_estreno'];
        }
        if ( ! $genero || empty($genero) ) {
            $gen=Pelicula::buscaPelicula_genero($datos['tituloprem']);
            $genero=$gen['genero'];
        }

        if (count($this->errores) === 0) {
            /*
            $tipo = $_FILES['archivo']['type'];
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            */
            
            $dir=$peli['direccion_fotografia'];
            //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño                
                                            //($titulo_prem,$titulo,$descripcion,$alt,$fecha_estreno,$temp,$dir,$genero)
                if(!Pelicula::modificaPelicula($datos['tituloprem'],$titulo,$desc,$alt,$fecha_estreno,$temp,$dir,$genero)){
                    $this->errores[]='ha sucedido un error al modificar la pelicula o no existia dicha pelicula';
                }
            
            
        }
                
    }
    
}


?>