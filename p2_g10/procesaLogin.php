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
    if ($conn->connect_error){
        die("La conexión ha fallado" . $conn->connect_error);
    }

    //quitamos la insercion de codigo html y php
    $contacto = $conn->real_escape_string($_POST['contacto']);
    //buscamos la contraseña ya encriptada ya que es lo que almacenamos (tema de seguridad)
    $pass= $conn->real_escape_string($_POST['password']);
    // Creamos la consulta
    $query = "SELECT * FROM usuarios WHERE contacto = '$contacto'";
    // Realizamos la consulta
    $result = $conn->query($query);

    if ($result->num_rows > 0){
        //recuperamos los resultados
        $reg = $result->fetch_assoc();
        //seteamos con lo devuelto por la consulta
        if(password_verify($pass,$reg['pass'])){
            $_SESSION['login']=true;
            $_SESSION['nombre']=$reg['nombre'];
            $_SESSION['contacto']=$reg['contacto'];
            $_SESSION['admin']=$reg['admin'];
        }
        else{
            if(isset($_SESSION['login'])){
                unset($_SESSION['login']);
            }
            if(isset($_SESSION['nombre'])){
                unset($_SESSION['nombre']);
            }
            if(isset($_SESSION['contacto'])){
                unset($_SESSION['contacto']);
            }
            if(isset($_SESSION['admin'])){
                unset($_SESSION['admin']);
            }
        }
    }
    else{
        
        if(isset($_SESSION['login'])){
            unset($_SESSION['login']);
        }
        if(isset($_SESSION['nombre'])){
            unset($_SESSION['nombre']);
        }
        if(isset($_SESSION['contacto'])){
            unset($_SESSION['contacto']);
        }
        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }


    }
    $conn->close();
?>

<!DOCTYPE html>
<html lang ="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Procesado de login</title>
    </head>

    <body>
        <div id="contenedor">
            <?php 
                if(isset($_SESSION['login'])){
                    
                    //Si se inicia sesión con éxito se devuelve al usuario a la página principal
                    header('Location: ./index.php');
                    exit;
                }
                else{
                    
                    //Si el contacto o contraseña son incorrectos se manda a la página de login con un error
                    $_SESSION['loginFallido'] = true;
                    header('Location: ./login.php');
                    exit;
                }
            ?>
        </div>
    </body>
</html>

