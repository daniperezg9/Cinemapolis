<?php 
namespace cinemapolis;

class Pelicula{

    private $titulo;
    private $sinopsis;
    private $foto;

    public static function ListaPeliculas(){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM peliculas";
        $result = $conn->query($query);
        return $result;

    }

    public static function buscaPelicula($titulo){

        if (!$titulo) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();

        $t= $conn->real_escape_string($titulo);

        $query = "SELECT titulo FROM peliculas WHERE titulo = '$t' ";

        $result = $conn->query($query);

        if ($result->num_rows == 1){
            return $row= $result->fetch_array();
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

    public static function buscaPelicula_genero($titulo)
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
    }


}


