<?php 
namespace cinemapolis;

class Pelicula{

    private $titulo;
    private $descripcion;
    private $alt;
    private $fecha_estreno;
    private $dir_foto;
    private $genero;

    
    private function __construct($titulo,$descripcion, $alt,$fecha_estreno,$dir_foto,$genero) {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->alt = $alt;
        $this->fecha_estreno = $fecha_estreno;
        $this->dir_foto = $dir_foto;
        $this->genero = $genero;
    }
    
    public static function ListaPeliculas(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM peliculas p JOIN `genero_peliculas` pg ON p.titulo = pg.titulo";
        $rs = $conn->query($query);
        $result=[];
        $i=0;
        if($rs->num_rows > 0){
            foreach($rs as $row){
                $result[$i]=new Pelicula($row['titulo'],$row['descripcion'], $row['alt'],$row['fecha_estreno'],$row['direccion_fotografia'],$row['genero']);
                $i++;
            }
            $rs->free();
            return $result;
        }
        
        return false;
    }

    public static function buscaPelicula($titulo){

        if (!$titulo) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $t= $conn->real_escape_string($titulo);

        $query = "SELECT * FROM peliculas p JOIN `genero_peliculas` pg ON p.titulo = pg.titulo  WHERE p.titulo = '$t' ";

        $result=$conn->query($query);

        if ($result->num_rows == 1){
            $row= $result->fetch_array();
            $pelicula=new Pelicula($row['titulo'],$row['descripcion'], $row['alt'],$row['fecha_estreno'],$row['direccion_fotografia'],$row['genero']);
            $result->free();
            return $pelicula ;
        }

        return false;
    }

    public static function insertaPelicula($titulo,$descripcion,$alt,$fecha_estreno,$archivo,$temp,$genero){
        
        

        if (!$titulo||!$descripcion||!$alt||!$fecha_estreno) {
            return false;
        } 
        $conn = Aplicacion::getInstance()->getConexionBd();

        if(!self::buscaPelicula($titulo)){
            $t= $conn->real_escape_string($titulo);
            $d=$conn->real_escape_string($descripcion);
            $a=$conn->real_escape_string($alt);
            $f=$conn->real_escape_string($fecha_estreno);
            $g=$conn->real_escape_string($genero);

            

            $dir='./images/'.date("Y-m-d-H-i-s-").$archivo;
            if (move_uploaded_file($temp, $dir)) {
                
                chmod($dir, 0777);
                $query = "INSERT INTO peliculas (titulo, descripcion, fecha_estreno,direccion_fotografia,alt) VALUES ('$t', '$d', '$f','$dir','$a')";
            
                $result = $conn->query($query);

                $query = "INSERT INTO genero_peliculas (titulo, genero) VALUES ('$t', '$g')";
            
                $result = $conn->query($query);

                return true;
            }

        return false;

        }
    }
                                            
    public static function modificaPelicula($titulo_prem,$titulo,$descripcion,$alt,$fecha_estreno,$temp,$dir,$genero){
        
        

        if (!$titulo||!$descripcion||!$alt||!$fecha_estreno) {
            return false;
        } 
        $conn = Aplicacion::getInstance()->getConexionBd();

        if($peli=self::buscaPelicula($titulo_prem)){
            $tp=$conn->real_escape_string($titulo_prem);
            $t= $conn->real_escape_string($titulo);
            $d=$conn->real_escape_string($descripcion);
            $a=$conn->real_escape_string($alt);
            $f=$conn->real_escape_string($fecha_estreno);
            $g=$conn->real_escape_string($genero);
            if($temp===$dir){

                $query = "UPDATE peliculas  SET titulo = '$t', descripcion = '$d', fecha_estreno='$f',alt='$a' where titulo ='$tp' ";
                
                    $result = $conn->query($query);
    
                    $query = "UPDATE genero_peliculas SET titulo='$t', genero = '$g' WHERE titulo='$tp'";
                
                    $result = $conn->query($query);

                return true;
            }
            else{
                if(file_exists($dir)){
                    unlink($dir);
                }
                
                if (move_uploaded_file($temp, $dir)) {
                    
                    chmod($dir, 0777);
                    $query = "UPDATE peliculas  SET titulo = '$t', descripcion = '$d', fecha_estreno='$f',alt='$a' where titulo ='$tp' ";
                
                    $result = $conn->query($query);
    
                    $query = "UPDATE genero_peliculas SET titulo='$t', genero = '$g' WHERE titulo='$tp'";
                
                    $result = $conn->query($query);
    
                    return true;
                }
            }

        return false;

        }
    }

    public static function borrarPelicula($titulo)
    {
        if (!$titulo) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $t= $conn->real_escape_string($titulo);

        $query = "DELETE FROM peliculas WHERE titulo = '$t'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        $query = "DELETE FROM genero_peliculas WHERE titulo = '$t'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    /*public static function buscaPelicula_genero($titulo)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();

        $t= $conn->real_escape_string($titulo);
        $query = "SELECT pg.genero AS genero, p.fecha_estreno AS fecha_estreno , p.direccion_fotografia AS dir , p.alt AS alt , p.descripcion AS descr FROM `peliculas` p JOIN `genero_peliculas` pg ON p.titulo = pg.titulo WHERE p.titulo ='$t'";
        // Realizamos la consulta
        $result = $conn->query($query);

        if($result){
            return $row = $result->fetch_array();
        }
        return false;
    }*/




    public function get_titulo(){
        return $this->titulo;
    }
    public function get_descripcion(){
        return $this->descripcion;
    }
    public function get_alt(){
        return $this->alt;
    }
    public function get_fecha_estreno(){
        return $this->fecha_estreno;
    }
    public function get_genero(){
        return $this->genero;
    }

    public function get_dir_foto(){
        return $this->dir_foto;
    }

}


