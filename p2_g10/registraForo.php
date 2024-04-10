<?php
session_start();
//Definicion de constantes
//Parametros de acceso de la base de datos
    define('BD_HOST', 'localhost');
    define('BD_USER', 'usuarios');
    define('BD_PASS', 'usuariospass');
    define('BD_NAME', 'cinemapolis');
    //abrimos conexión 
    $conn = new mysqli(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    if (mysqli_connect_errno()){
        die("error de conexión con BBDD". mysqli_connect_error());
    }

    //quitamos la insercion de codigo html y php
    $contacto =$conn->real_escape_string($_POST['contacto']) ;
    //buscamos la contraseña ya encriptada ya que es lo que almacenamos (tema de seguridad)
    $id_foro=$conn->real_escape_string($_POST['id_foro']) ;
    // Creamos la consulta12
    $descripcion=$conn->real_escape_string($_POST['descripcion']) ;

    $query = "SELECT id_foro FROM lista_foros WHERE id_foro = '$id_foro' AND contacto ='$contacto' ";
    // Realizamos la consulta
    $result = $conn->query($query);

    if ($result->num_rows == 0){
        //recuperamos los resultados
        
        $query = "INSERT INTO lista_foros (contacto, id_foro, descripcion) VALUES ('$contacto', '$id_foro', '$descripcion')";
        //seteamos con lo devuelto por la consulta
        $result = $conn->query($query);
        
        //envía a pagina del foro
        //$creado=true;
    }
    else{
        //recarga página de creación mostrando error
        //$creado=false;
    }
    $conn->close();
?>

