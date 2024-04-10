<?php 
namespace cinemapolis;
require_once __DIR__.'/includes/config.php';

$tituloPagina = 'Log in';

$mensajeError = '';
if(isset($_SESSION['loginFallido']) && $_SESSION['loginFallido']== true){
    $mensajeError = '<p>La dirección de correo o la contraseña son erróneas.</p>';
}

$contenidoPrincipal = <<<EOS
    $mensajeError
    <!--Formulario para iniciar sesión-->
    <form action = "./procesaLogin.php" method = "post">
        <fieldset id=loginFieldset>
            <legend>Inicia sesión</legend>
            Correo electrónico:<br> <input type="text" name="contacto"><br>
            Contraseña:<br> <input type="password" name="password"><br>	
            <input type="submit" name="Enviar">
        </fieldset>
    </form> 
EOS;

require __DIR__.'/includes/vistas/plantillas/plantilla.php';