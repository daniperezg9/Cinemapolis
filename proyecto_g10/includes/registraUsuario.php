<?php
namespace cinemapolis\src;
require_once __DIR__.'/includes/config.php';
//Definicion de constantes
//Parametros de acceso de la base de datos
    
    //abrimos conexión 

    $user=Usuario::inserta_user($_POST['nombre'],$_POST['contacto'], 0, $_POST['password']);
    
    
    if ($user!=false){
        $creado=true;
    }
    else{
        $creado=false;
    }

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
                    $_SESSION['nombre']=$user->get_nombre_usuario();
                    $_SESSION['contacto']= $user->get_contacto_usuario();
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


