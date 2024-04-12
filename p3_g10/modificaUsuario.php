<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$mensajeError = '';

    if(isset($_POST['modifica_usuario'])&& isset($_SESSION['esAdmin']) && $_SESSION['Admin']==true && !isset($_POST['aceptarUsuario'])&& !isset($_POST['aceptarAdmin'])){

        $tituloPagina = 'Modificar perfil';

        $contacto=$_SESSION['contacto'];
        $nombre=$_SESSION['nombre'];
        $contenidoPrincipal = <<<EOS
        $mensajeError
        <!--Formulario para modificar usuario (el propio)-->
        <form action = "./modificaUsuario.php" method = "post">
            <fieldset id=loginFieldset>
                <legend>Datos de usuario</legend>
                Correo electrónico:$contacto<br>
                Nombre:<input type="text" name="nombre" value=$nombre><br>
                Contraseña:<input type="password" name="password"><br>
                <input type="hidden" name= "aceptarUsuario" value=true">
                <input type="submit" name="Enviar">
            </fieldset>
        </form> 
        EOS;

    
    }
    else if(isset($_POST['modifica_usuario']) && isset($_SESSION['Admin'])&& $_SESSION['Admin']==false && !isset($_POST['aceptarUsuario'])&& !isset($_POST['aceptarAdmin']) ){

        $tituloPagina = 'Modificar perfil';

        if(isset($_SESSION['modificaNoAdmin'])){
            
            if(($user=Usuario::buscaUserPorCorreo($_POST['contacto']))!=false){

                $nombre=$user->get_nombre_usuario();
                $pass=$user->get_password_usuario();
                $contacto=$user->get_contacto_usuario();

                $contenidoPrincipal = <<<EOS
                $mensajeError
                <!--Formulario para modificar usuario (de otro user)-->
                <form action = "./modificaUsuario.php" method = "post">
                    <fieldset id=loginFieldset>
                        <legend>Datos de usuario</legend>
                        
                        Correo electrónico:$user->get_contacto_usuario<br>
                        Nombre:<input type="text" name="nombre" value=$nombre><br>
                        Contraseña:<input type="hiden" name="password" value=$pass><br>
                        <input type="hidden" name= "contacto" value=$contacto">
                        Admin:<input type="text" name="esAdmin" value=0><br>
                        <input type="hidden" name= "aceptarAdmin" value=true">
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form> 
                EOS;
            }
            else{
                $mensajeError = 'No se ha encontrado ningún usuario con correo '.$_POST['contacto'].' recomendamos que recargue la pagina.';
                $contenidoPrincipal = <<<EOS
                $mensajeError
                EOS;
            }

        }
        else{
            $nombre=$_SESSION['nombre'];
            $contacto=$_SESSION['contacto'];

            $contenidoPrincipal = <<<EOS
            $mensajeError
            <!--Formulario para modificar usuario (el propio)-->
            <form action = "./modificaUsuario.php" method = "post">
                <fieldset id=modificaUser>
                    <legend>Datos de usuario</legend>
                    
                    Correo electrónico:$contacto<br>
                    Nombre:<input type="text" name="nombre" value=$nombre><br>
                    Contraseña:<input type="password" name="password"><br>
                    <input type="hidden" name= "aceptarUsuario" value=true">
                    <input type="submit" name="Enviar">
                </fieldset>
            </form> 

            <form action = "./modificaUsuario.php" method = "post">
                <fieldset id=modificaUserNoAdmin>
                    <legend>Modificar otro usuario</legend>
                    Correo electrónico:<input type="contacto" name="contacto"><br>
                    <input type="hidden" name= "modificaNoAdmin" value=true">
                    <input type="submit" name="Enviar">
                </fieldset>
            </form> 
            EOS;
        }


    }
    else if(isset($_POST['aceptarUsuario'])){
        $user=Usuario::buscaUserPorCorreo($_SESSION['contacto']);
        $user->set_nombre_usuario($_POST['nombre']);
        $user->set_password_usuario($_POST['password']);
        $user->modifica_usuario($user);
        $_SESSION['nombre']=$user->get_nombre_usuario();
        $tituloPagina = 'Modificación realizada';
        $nombre=$_SESSION['nombre'];
        $contacto=$_SESSION['contacto'];
        $contenidoPrincipal = <<<EOS
            $mensajeError
            <!--Formulario para modificar usuario (el propio)-->
            Se han modificado exitosamente los datos
            Correo electrónico:$contacto<br>
            Nombre:$nombre><br>
            EOS;
    }
    else if(isset($_POST['aceptarAdmin'])){
        $user=Usuario::buscaUserPorCorreo($_POST['contacto']);
        $user->set_nombre_usuario($_POST['nombre']);
        $user->set_esAdmin_usuario($_POST['esAdmin']);
        $user->modifica_usuario($user);
        $tituloPagina = 'Modificación realizada';
        $nombre=$user->get_nombre_usuario();
        $contacto=$user->get_contacto_usuario();
        $admin=$user->get_esAdmin_usuario();
        $contenidoPrincipal = <<<EOS
            $mensajeError
            <!--Formulario para modificar usuario (el propio)-->
            Se han modificado exitosamente los datos

            Correo electrónico:$contacto<br>
            Nombre:$nombre<br>
            Admin:$admin<br>
            EOS;
    }

    else{
        $tituloPagina = 'Mostrar perfil';

        if(isset($_SESSION['loginFallido']) && $_SESSION['loginFallido']== true){
            $mensajeError = '<p>La dirección de correo o la contraseña son erróneas.</p>';
        }

        $contacto=$_SESSION['contacto'];
        $nombre=$_SESSION['nombre'];

        $contenidoPrincipal = <<<EOS
        $mensajeError
        
        Correo electrónico:$contacto<br>
        Nombre:$nombre<br>


        <!--Formulario para iniciar sesión-->
        <form action = "./modificaUsuario.php" method = "post">
            <fieldset id=modificarUsuario>
                <input type="hidden" name="modifica_usuario" value=true">
                <input type="submit" name="modificar usuario">
            </fieldset>
        </form> 
        EOS;
    }
    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>