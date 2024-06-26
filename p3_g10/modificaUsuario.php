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
        <fieldset id=modificaFieldset>
        <form action = "./modificaUsuario.php" method = "post">
                <h1>Modificar datos</h1>
                <p> 
                <strong>Correo electrónico:</strong> $contacto<br>
                Nombre:<input type="text" name="nombre" value=$nombre><br>
                Contraseña:<input type="password" name="password"><br>
                <input type="hidden" name= "aceptarUsuario" value=true">
                <input type="submit" name="Enviar">
                </p>
        </form>

        <form action = "./modificaUsuario.php" method = "post">
                
                    <h1>Borrar usuario</h1>
                    <p>
                    <input type="hidden" name="borra_usuario" value=true>
                    Si deseas borrar tu cuenta escribe <strong>$contacto</strong> <input type="text" name="confirmación">
                    <input type="submit" name="borrar usuario" value="borrar usuario">
                    </p>
                
            </form>

        
        </fieldset>
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
                <fieldset id=modificaFieldset>
                <p>
                <form action = "./modificaUsuario.php" method = "post">
                        <h1>Modificar usuario de $contacto</h1>
                        <strong>Correo electrónico:</strong> $contacto<br><br>
                        Nombre:<input type="text" name="nombre" value=$nombre><br><br>
                        <input type="hidden" name="password" value=$pass>
                        <input type="hidden" name= "contacto" value=$contacto>
                        Admin:<input type="text" name="esAdmin" value=0><br><br>
                        <input type="hidden" name= "aceptarAdmin" value=true"><br>
                        <input type="submit" name="Enviar">
                    
                </form> 

                <form action = "./modificaUsuario.php" method = "post">
                    <h1>Borrar usuario de $contacto</h1>
                    <input type="hidden" name="borra_usuario_admin" value=true>
                    <input type="hidden" name= "contacto" value=$contacto>
                    Si deseas borrar la cuenta escribe <strong>$contacto</strong> <input type="text" name="confirmación">
                    <input type="submit" name="borrar usuario" value="borrar usuario">
                
                </form>
                </p> 
                </fieldset>

                EOS;
            }
            //Usuario no encontrado
            else{


                $contacto=$_SESSION['contacto'];
                $nombre=$_SESSION['nombre'];


                $mensajeError = '<p>No se ha encontrado ningún usuario con correo "'.$_POST['contacto'].'"</p>';
                $contenidoPrincipal = <<<EOS
                $mensajeError
                <fieldset id=modificaFieldset>
                <p>
                
    
                <!--Formulario para iniciar sesión-->
                <form action = "./modificaUsuario.php" method = "post">
                    <h1>Modificar usuario</h1>
                    <strong>Correo electrónico:</strong> $contacto<br>
                    <strong>Nombre:</strong> $nombre<br>
                    <input type="hidden" name="modifica_usuario" value=true>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario propio">
                    <br><br>
                
                </form> 
    
                <form action = "./modificaUsuario.php" method = "post">
                    <h1>Buscar usuario para modificar</h1>
                    Correo electrónico del usuario a modificar:
                    <input type="text" name="contacto">
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="hidden" name="modificaNoAdmin" value=true>
                    <br>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                </form>
                </p>
                </fieldset>
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
                <fieldset id=modificaFieldset>
                    
                    <h1>Modificar usuario</h1>
                    <strong>Correo electrónico:</strong> $contacto<br>
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
            <fieldset id=modificaFieldset>
            Se han modificado los datos  exitosamente
            <br>
            <br>
            <strong>Correo electrónico:</strong> $contacto<br><br>
            <strong>Nombre:</strong>$nombre
            </fieldset>
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
            $mensajeError
            <!--Formulario para modificar usuario (el propio)-->
            <fieldset id=modificaFieldset>
            Se han modificado los datos  exitosamente
            <br>
            <br>
            <strong>Correo electrónico:</strong> $contacto<br><br>
            <strong>Nombre:</strong> $nombre<br><br>
            <strong>Admin:</strong> $admin
            </fieldset>
            EOS;


        }

    else if(isset($_POST['borra_usuario'])){

        if($_POST['confirmación']==$_SESSION['contacto']){
            
            $contacto=$_SESSION['contacto'];

            $user=Usuario::buscaUserPorCorreo($_POST['confirmación']);
            $user->borraPorCorreo($user->get_contacto_usuario());

            

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
            <fieldset id=modificaFieldset>
            La cuenta asociada a <strong>$contacto</strong> ha sido borrada exitosamente.
            </fieldset>
            
            EOS;

        }
        else{

            $contacto=$_SESSION['contacto'];
            $nombre=$_SESSION['nombre'];

            $mensajeError="<h1>La confirmación falló</h1>";
            $contenidoPrincipal = <<<EOS
            $mensajeError
            
            
    
    
            <!--Formulario para iniciar sesión-->
            <fieldset id=modificaFieldset>
            <form action = "./modificaUsuario.php" method = "post">
                    <h1>Modificar usuario</h1>
                    <strong>Correo electrónico:</strong> $contacto<br>
                    <strong>Nombre:</strong>$nombre<br>
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                
            </form> 

            <form action = "./modificaUsuario.php" method = "post">
                    <h1>Borrar usuario</h1>
                    <input type="hidden" name="borra_usuario" value=true>
                    Si deseas borrar tu cuenta escribe <strong>$contacto</strong> <input type="text" name="confirmación">
                    <input type="submit" name="borrar usuario" value="borrar usuario">
                
            </form> 
            </fieldset>
            EOS;
        }

    }

    else if(isset($_POST['borra_usuario_admin'])){
        if($_POST['confirmación']==$_POST['contacto']){
            $contacto=$_POST['contacto'];
            $user=Usuario::buscaUserPorCorreo($_POST['confirmación']);
            $user->borraPorCorreo($user->get_contacto_usuario());


            $contenidoPrincipal = <<<EOS
            $mensajeError
            <fieldset id=modificaFieldset>
            La cuenta vinculada a <strong>$contacto<strong> ha sido borrada con exito
            </fieldset>
            
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
            
                

                <!--Formulario para iniciar sesión-->
                <fieldset id=modificaFieldset>
                <form action = "./modificaUsuario.php" method = "post">
                    <strong>Correo electrónico:</strong> $contacto<br>
                    <strong>Nombre:</strong> $nombre<br>
                    <input type="hidden" name="modifica_usuario" value=true>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario propio">
                    <br><br>
                
                </form> 

                <form action = "./modificaUsuario.php" method = "post">
                    <h1>Buscar usuario para modificar</h1>
                    Correo electrónico del usuario a modificar:
                    <input type="text" name="contacto">
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="hidden" name="modificaNoAdmin" value=true>
                    <br>
                    <br>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                </form>
                </fieldset>
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

            <fieldset id=modificaFieldset>
            <h1>Datos de usuario</h1>
            <p>
            <strong>Correo electrónico:</strong> $contacto<br>
            <strong>Nombre:</strong> $nombre<br>

            <!--Formulario para iniciar sesión-->
            <form action = "./modificaUsuario.php" method = "post">
                <input type="hidden" name="modifica_usuario" value=true>
                <br>
                <input type="submit" name="modificar usuario" value="modificar usuario propio">
                <br><br>
            
            </form> 
            
            <form action = "./modificaUsuario.php" method = "post">
                <h1>Buscar usuario para modificar</h1>
                Correo electrónico del usuario a modificar:
                <input type="text" name="contacto">
                <input type="hidden" name="modifica_usuario" value=true>
                <input type="hidden" name="modificaNoAdmin" value=true>
                <br>
                <br>
                <input type="submit" name="modificar usuario" value="modificar usuario">
                </form>
                </p>
            </fieldset>
                
        EOS;

        }
        //NO ADMIN
        if(isset($_SESSION['admin']) && $_SESSION['admin']==0){
            $contenidoPrincipal = <<<EOS
            $mensajeError
            <fieldset id=modificaFieldset>
            <h1>Datos de usuario</h1>
            <p>
            <strong>Correo electrónico:</strong> $contacto<br>
            <strong>Nombre:</strong>$nombre<br>
    
    
            <!--Formulario para iniciar sesión-->
            <form action = "./modificaUsuario.php" method = "post">
                
                    <input type="hidden" name="modifica_usuario" value=true>
                    <input type="submit" name="modificar usuario" value="modificar usuario">
                
            </form>  
            </p>
            </fieldset>
            EOS;

        }

    }
    require __DIR__.'/includes/vistas/plantillas/plantilla.php';
?>