<?php
namespace cinemapolis\src;
require_once __DIR__.'includes/config.php';
session_start();
//Definicion de constantes
//Parametros de acceso de la base de datos
    //abrimos conexión 
    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if (mysqli_connect_errno()){
        die("error de conexión con BBDD". mysqli_connect_error());
    }

    $contacto =$conn->real_escape_string($_POST['contacto']) ;
    $nombre_evento=$conn->real_escape_string($_POST['nombre_evento']) ;
    $fecha_evento=$conn->real_escape_string($_POST['fecha_evento']) ;
    // Creamos la consulta12
    $descripcion=$conn->real_escape_string($_POST['descripcion']) ;

    $query = "SELECT nombre_evento FROM lista_eventos WHERE nombre_evento = '$nombre_evento' AND contacto ='$contacto' AND fecha_evento='$fecha_evento'";
    // Realizamos la consulta
    $result = $conn->query($query);

    if ($result->num_rows == 0){
        //recuperamos los resultados
        
        $query = "INSERT INTO lista_eventos (contacto, nombre_evento,fecha_evento, descripcion) VALUES ('$contacto', '$nombre_evento','$fecha_evento', '$descripcion')";
        //seteamos con lo devuelto por la consulta
        $result = $conn->query($query);
        
        //envía a pagina del evento
        //$creado=true;
    }
    else{
        //recarga página de creación mostrando error
        //$creado=false;
    }
    $conn->close();
?>