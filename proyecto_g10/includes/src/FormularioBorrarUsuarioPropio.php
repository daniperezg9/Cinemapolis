<?php
namespace cinemapolis\src;

class FormularioBorrarUsuarioPropio extends Formulario{

    public function __construct(){
        parent::__construct('formborrauserpropio', ['urlRedireccion' => 'index.php', 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $conf = $datos['conf'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['conf'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $correo=$_SESSION['contacto'];

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Borrar tu usuario</legend>
            <div>
                <p>Escribe tu correo [ $correo ] para borrar la cuenta</p>
                <label for="conf">Confirmación:</label>
                <input id="conf" type="text" name="conf" value="$conf" />
                <p>{$erroresCampos['conf']}
            </div>
            <button type="submit" name="Enviar">Borrar usuario</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $conf = trim($datos['conf'] ?? '');
        $conf = filter_var($conf, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $conf || empty($conf) ) {
            $this->errores['conf'] = 'Sin confirmación no se puede borrar la cuenta.';
        }

        if($conf != filter_var($_SESSION['contacto'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)){
            $this->errores['conf'] = 'La confirmación no corresponde con tu cuenta.';
        }

        if (count($this->errores) === 0){

            $correo=$_SESSION['contacto'];
            $usuario = Usuario::buscaUserPorCorreo($correo);
            
            if(!$usuario){
                $this->errores[] = "Este correo [ $correo ] no deberia estar vinculado a tu cuenta";
            }
            else{
                if (!Usuario::borraPorCorreo($correo)){
                    $this->errores[] = "El usuario no ha podido ser borrado en la base de datos";
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
                
        }
    }
}


?>