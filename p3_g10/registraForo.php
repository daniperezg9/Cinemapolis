<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    //abrimos conexión 
    $app = Aplicacion::getInstance();
    $conn = $app->getConexionBd();
    if (mysqli_connect_errno()){
        die("error de conexión con BBDD". mysqli_connect_error());
    }

    //quitamos la insercion de codigo html y php
    $contacto =$conn->real_escape_string($_SESSION['contacto']) ;
    $id_foro=$conn->real_escape_string($_POST['id_foro']) ;
    $descripcion=$conn->real_escape_string($_POST['descripcion']) ;

    $query = "SELECT id_foro FROM lista_foros WHERE id_foro = '$id_foro' AND contacto ='$contacto' ";
    // Realizamos la consulta
    $result = $conn->query($query);

    if ($result->num_rows == 0){      
        $result->free();  
        $query = "INSERT INTO lista_foros (contacto, id_foro, descripcion) VALUES ('$contacto', '$id_foro', '$descripcion')";
        //seteamos con lo devuelto por la consulta
        $result = $conn->query($query);
    }

    $conn->close();
    header('Location: ./foro.php');
?>

