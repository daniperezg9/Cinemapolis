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
    
    // Creamos la consulta12
    $query = "SELECT contacto FROM usuarios WHERE contacto = '$contacto' ";
    // Realizamos la consulta
    $result = $conn->query($query);
    if ($result->num_rows == 0){
        //recuperamos los resultados
        $pass= password_hash($conn->real_escape_string($_POST['password']), PASSWORD_BCRYPT);
        $contacto = $conn->real_escape_string($_POST['contacto']);
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $query = "INSERT INTO usuarios (nombre, contacto, admin, pass) VALUES ('$nombre', '$contacto', FALSE, '$pass')";
        //seteamos con lo devuelto por la consulta
        $result = $conn->query($query);
        $creado=true;
    }
    else{
        $creado=false;
    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang ="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Registro de usuario</title>
    </head>

    <body>
        <div id="contenedor">
            <?php 
                if($creado){
                    
                    //Si se crea con éxito la cuenta se guardan los datos de sesión y se devuelve al usuario a la página principal
                    $_SESSION['login']=true;
                    $_SESSION['nombre']=$nombre;
                    $_SESSION['contacto']= $contacto;
                    $_SESSION['admin']=false;
                    header('Location: ./index.php');
                    exit;
                }
                else{
                    
                    //Si el contacto ya existía no se crea el usuario y se manda a la página de signup con un error
                    $_SESSION['signupFallido'] = true;
                    header('Location: ./signup.php');
                    exit;
                }
            ?>
        </div>
    </body>
</html>


