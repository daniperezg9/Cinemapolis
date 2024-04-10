<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';
    
    $user =Usuario::login($_POST['contacto'],$_POST['password']);

    if ($user!=false){
            $_SESSION['login']=true;
            $_SESSION['nombre']=$user->get_nombre_usuario();
            $_SESSION['contacto']=$user->get_contacto_usuario();
            $_SESSION['admin']=$user->get_esAdmin_usuario();
        
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
?>

<!DOCTYPE html>
<html lang ="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Procesado de login</title>
    </head>
    <?php require "./includes/vistas/comun/cabecera.php";?>
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

