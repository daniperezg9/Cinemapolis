<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Sign up';

$mensajeError = '';
if(isset($_SESSION['signupFallido']) && $_SESSION['signupFallido']== true){
    $mensajeError = '<p>La dirección de correo ya tiene asociada una cuenta.</p>';
}

$contenidoPrincipal = <<<EOS
    $mensajeError
    <!--Formulario para registrarse-->
    <form action = "./registraUsuario.php" method = "post">
        <fieldset id = signupFieldset>
            <legend>Crea una cuenta</legend>
            Nombre:<br> <input type="text" name="nombre"><br>
            Correo electrónico:<br> <input type="text" name="contacto"><br>
            Contraseña:<br> <input type="password" name="password"><br>	
            <input type="submit" name="Enviar">
        </fieldset>
    </form> 
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';