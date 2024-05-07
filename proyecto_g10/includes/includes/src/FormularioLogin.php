<?php
namespace cinemapolis\src;

class FormularioLogin extends Formulario{

    public function __construct(){
        parent::__construct('formlogin', ['urlRedireccion' => 'index.php']);
    }

    protected function generaCamposFormulario(&$datos){

        
        $contacto = $datos['contacto'] ?? '';
        $password = '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['contacto', 'password','ini'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Inicia sesión</legend>
            <p>{$erroresCampos['ini']}</p>
            <label for="contacto">Correo electrónico: </label>
            <input id="contacto" type="email" name="contacto" value="$contacto"><br>
            <p>{$erroresCampos['contacto']}</p>
            <label for="password">Contraseña: </label>
            <input id"password" type="password" name="password"><br>
            <p>{$erroresCampos['password']}</p>

            <button type="submit" name="Enviar">Iniciar sesion</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $contacto = trim($datos['contacto'] ?? '');
        $contacto = filter_var($contacto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $contacto || empty($contacto)) {
            $this->errores['contacto'] = 'El correo no puede estar vacío.';
        }

        $password = trim($datos['password'] ?? '');
        $password = filter_var($password, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $password || empty($password)) {
            $this->errores['password'] = 'La contraseña no puede estar vacía.';
        }
        $contacto = trim($datos['contacto'] ?? '');
        $contacto = filter_var($contacto, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $contacto || empty($contacto)) {
            $this->errores['contacto'] = 'El correo no puede estar vacío.';
        }
        else if(!$user=Usuario::login($contacto, $password)){
            $this->errores['ini'] = 'Los datos de inicio de sesión no son correctos.';
        }
        if (count($this->errores) === 0) {
            $_SESSION['login']=true;
            $_SESSION['nombre']=$user->get_nombre_usuario();
            $_SESSION['contacto']=$user->get_contacto_usuario();
            $_SESSION['admin']=$user->get_esAdmin_usuario();
        }
    }
}