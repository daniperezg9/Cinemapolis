<?php 
namespace cinemapolis;

class Pelicula{

    private $titulo;
    private $sinopsis;
    private $foto;

    public static function buscaPeliculaPorTitulo($titulo){
        $conn= Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        $query = "SELECT * FROM pelicula WHERE titulo = '$titulo'";
        $result = $conn->query($query);
        $user=false;
        if ($result->num_rows > 0){
            $reg = $result->fetch_assoc();
            $user=new Usuario($reg['nombre'], $reg['contacto'], $reg['admin'], $reg['pass']);
            
        } 
        $result->free();
        return $titulo;
    }

    public static function borraPelicula($titulo)
    {
        if (!$titulo) {
            return false;
        } 
        
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "DELETE FROM peliculas WHERE titulo = '$titulo'";
        if ( !$conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

   

}


