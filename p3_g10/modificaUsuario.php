<?php
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$mensajeError = '';
    //NO ADMIN MODIFICA SU USUARIO
    if(isset($_POST['modifica_usuario'])&& isset($_SESSION['admin']) && $_SESSION['admin']==0 && !isset($_POST['aceptarUsuario'])&& !isset($_POST['aceptarAdmin'])){

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
    //ADMIN MODIFICA:
    else if(isset($_POST['modifica_usuario']) && isset($_SESSION['admin'])&& $_SESSION['admin']==1 && !isset($_POST['aceptarUsuario'])&& !isset($_POST['aceptarAdmin']) ){

        $tituloPagina = 'Modificar perfil';
        //USUARIO DE OTRA PERSONA
        if(isset($_POST['modificaNoAdmin'])){
            
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
                        
                        Correo electrónico: $contacto<br><br>
                        Nombre:<input type="text" name="nombre" value=$nombre><br><br>
                        <input type="hidden" name="password" value=$pass>
                        <input type="hidden" name= "contacto" value=$contacto>
                        Admin:<input type="text" name="esAdmin" value=0><br><br>
                        <input type="hidden" name= "aceptarAdmin" value=true"><br>
                        <input type="submit" name="Enviar">
                    </fieldset>
                </form> 

                <form action = "./modificaUsuario.php" method = "post">
                
                    <input type="hidden" name="borra_usuario_admin" value=true>
                    <input type="hidden" name= "contacto" value=$contacto>
                    Si deseas borrar tu cuenta escribe $contacto <input type="text" name="confirmación">
                    <input type="submit" name="borrar usuario" value="borrar usuario">
                
                </form> 


                EOS;
            }
            //Usuario no encontrado
            else{


                $contacto=$_SESSION['contacto'];
                $nombre=$_SESSION['nombre'];


                $mensajeError = '<p>No se ha encontrado ningún usuario con correo "'.$_POST['contacto'].'"</p>';
                $contenidoPrincipal = <<<EOS
                $mensajeError
            
                Correo electrónico: $contacto<br>
                Nombre: $nombre<br>
    
                <!--Formulario para iniciar sesión-->
                <form action = "./modificaUsuario.php" method = "post">
                    <input type="hidden" name="modifica_usuario" value=true>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario propio">
                    <br><br>
                
                </form> 
    
                <form action = "./modificaUsuario.php" method = "post">
                    Correo electrónico del usuario a modificar:
                    <input type="text" name="contacto">
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="hidden" name="modificaNoAdmin" value=true>
                    <br>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                </form>
    
            EOS;
            }

        }
        //SU USUARIO (UN ADMIN NO PUEDE BORRAR SU CUENTA)
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
            EOS;
        }


    }
    //SE MODIFICA EL USUARIO PROPIO
    else if(isset($_POST['aceptarUsuario'])){
        $user=Usuario::buscaUserPorCorreo($_SESSION['contacto']);
        $user->set_nombre_usuario($_POST['nombre']);
        $user->set_password_usuario($_POST['password']);
        $user->modificaUser($user);
        $_SESSION['nombre']=$user->get_nombre_usuario();
        $tituloPagina = 'Modificación realizada';
        $nombre=$_SESSION['nombre'];
        $contacto=$_SESSION['contacto'];
        $contenidoPrincipal = <<<EOS
            $mensajeError
            <!--Formulario para modificar usuario (el propio)-->
            Se han modificado exitosamente los datos
            <br>
            Correo electrónico:$contacto<br>
            Nombre:$nombre<br>
            EOS;
    }
    //ADMIN MODIFICA USUARIO AJENO O PROPIO
    else if(isset($_POST['aceptarAdmin'])){
        
        $user=Usuario::buscaUserPorCorreo($_POST['contacto']);

        $user->set_nombre_usuario($_POST['nombre']);
        $user->set_esAdmin_usuario($_POST['esAdmin']);
        
        $user->modificaUser($user);

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

    else if(isset($_POST['borra_usuario'])){

        if($_POST['confirmación']==$_SESSION['contacto']){
            
            $contacto=$_SESSION['contacto'];

            $user=Usuario::buscaUserPorCorreo($_POST['confirmación']);
            $user->borraPorCorreo($user->get_contacto_usuario());

            $msn="<p>La cuenta vinculada a $contacto ha sido borrada con exito</p>";

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

            $contenidoPrincipal = <<<EOS
            $mensajeError
            $msn
            
            EOS;

        }
        else{

            $contacto=$_SESSION['contacto'];
            $nombre=$_SESSION['nombre'];

            $mensajeError="<p>la confirmación falló</p>";
            $contenidoPrincipal = <<<EOS
            $mensajeError
            
            Correo electrónico:$contacto<br>
            Nombre:$nombre<br>
    
    
            <!--Formulario para iniciar sesión-->
            <form action = "./modificaUsuario.php" method = "post">
                
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                
            </form> 

            <form action = "./modificaUsuario.php" method = "post">
                
                    <input type="hidden" name="borra_usuario" value=true>
                    Si deseas borrar tu cuenta escribe $contacto <input type="text" name="confirmación">
                    <input type="submit" name="borrar usuario" value="borrar usuario">
                
            </form> 
            EOS;
        }

    }

    else if(isset($_POST['borra_usuario_admin'])){
        if($_POST['confirmación']==$_POST['contacto']){
            $contacto=$_POST['contacto'];
            $user=Usuario::buscaUserPorCorreo($_POST['confirmación']);
            $user->borraPorCorreo($user->get_contacto_usuario());

            $msn="<p>La cuenta vinculada a $contacto ha sido borrada con exito</p>";
            $contenidoPrincipal = <<<EOS
            $mensajeError
            $msn
            
            EOS;
        }
        else{
            $tituloPagina = 'Mostrar perfil';

        

            $contacto=$_SESSION['contacto'];
            $nombre=$_SESSION['nombre'];
            //ADMIN
            if(isset($_SESSION['admin']) && $_SESSION['admin']==1){
                
                $contenidoPrincipal = <<<EOS
                $mensajeError
            
                Correo electrónico: $contacto<br>
                Nombre: $nombre<br>

                <!--Formulario para iniciar sesión-->
                <form action = "./modificaUsuario.php" method = "post">
                    <input type="hidden" name="modifica_usuario" value=true>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario propio">
                    <br><br>
                
                </form> 

                <form action = "./modificaUsuario.php" method = "post">
                    Correo electrónico del usuario a modificar:
                    <input type="text" name="contacto">
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="hidden" name="modificaNoAdmin" value=true>
                    <br>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                </form>

            EOS;
            }
        }
    }

    else{
        $tituloPagina = 'Mostrar perfil';

        

        $contacto=$_SESSION['contacto'];
        $nombre=$_SESSION['nombre'];
        //ADMIN
        if(isset($_SESSION['admin']) && $_SESSION['admin']==1){
            
            $contenidoPrincipal = <<<EOS
            $mensajeError
        
            Correo electrónico: $contacto<br>
            Nombre: $nombre<br>

            <!--Formulario para iniciar sesión-->
            <form action = "./modificaUsuario.php" method = "post">
                <input type="hidden" name="modifica_usuario" value=true>
                <br>
                <input type="submit" name="modificar usuario" value="modificar usuario propio">
                <br><br>
            
            </form> 

            <form action = "./modificaUsuario.php" method = "post">
                Correo electrónico del usuario a modificar:
                <input type="text" name="contacto">
                <input type="hidden" name="modifica_usuario" value=true>
                <input type="hidden" name="modificaNoAdmin" value=true>
                <br>
                <br>
                <input type="submit" name="modificar usuario" value="modificar usuario">
            </form>

        EOS;

        }
        //NO ADMIN
        if(isset($_SESSION['admin']) && $_SESSION['admin']==0){
            $contenidoPrincipal = <<<EOS
            $mensajeError
            
            Correo electrónico:$contacto<br>
            Nombre:$nombre<br>
    
    
            <!--Formulario para iniciar sesión-->
            <form action = "./modificaUsuario.php" method = "post">
                
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                
            </form> 
            
            <form action = "./modificaUsuario.php" method = "post">
                
                    <input type="hidden" name="borra_usuario" value=true>
                    Si deseas borrar tu cuenta escribe $contacto <input type="text" name="confirmación">
                    <input type="submit" name="borrar usuario" value="borrar usuario">
                
            </form> 
            
            EOS;

        }

    }
    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>