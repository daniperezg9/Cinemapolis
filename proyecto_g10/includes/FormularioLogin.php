<?php
namespace cinemapolis;

class FormularioLogin extends Formulario{

    public function __construct(){
        parent::__construct('formlogin', ['urlRedireccion' => 'index.php']);
    }

    protected function generaCamposFormulario(&$datos){

        
        $contacto = $datos['contacto'] ?? '';
        $password = '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['contacto', 'password'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Inicia sesión</legend>
            Correo electrónico:<br> <input type="text" name="contacto"><br>
            <p>{$erroresCampos['contacto']}</p>

            Contraseña:<br> <input type="password" name="password"><br>	
            <p>{$erroresCampos['password']}</p>

            <button type="submit" name="Enviar">Editar</button>
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
        
        if(!$user=Usuario::login($contacto, $password)){
            $this->errores['contacto'] = 'No se pudo iniciar sesión con este correo';
        }
        if (count($this->errores) === 0) {
            $_SESSION['login']=true;
            $_SESSION['nombre']=$user->get_nombre_usuario();
            $_SESSION['contacto']=$user->get_contacto_usuario();
            $_SESSION['admin']=$user->get_esAdmin_usuario();
        }
    }
}