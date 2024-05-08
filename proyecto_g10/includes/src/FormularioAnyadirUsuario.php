<?php
namespace cinemapolis\src;

class FormularioAnyadirUsuario extends Formulario{

    public function __construct(){
        parent::__construct('formanyadirusuario', ['urlRedireccion' => 'index.php','enctype'=>'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $nombre = $datos['nombre'] ?? '';
        $correo = $datos['correo'] ?? '';
        $contra = $datos['contra'] ?? '';

        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'correo', 'contra'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset id=signupFieldset>
            <legend>Crea tu usuario</legend>
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                <p>{$erroresCampos['nombre']}</p>
            </div>
            <div>
                <label for="correo">Correo:</label>
                <input id="correo" type="email" name="correo" value="$correo" />
                <p>{$erroresCampos['correo']}</p>
                <span id="validEmail"><p id="emailOk">Correo disponible para crear cuenta</p><p id="emailMal">Este correo no es valido.</p></span>
            </div>
            <div>
                <label for="contra">Contraseña:</label>
                </br></br>
                <input id="contra" type="password" name="contra" value="$contra" />
                <p>{$erroresCampos['contra']}</p>
            </div>
            <button type="submit" name="Enviar">Crear usuario</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos)
    {
        $this->errores = [];

        $nombre = trim($datos['nombre'] ?? '');
        $nombre = filter_var($nombre, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $nombre || empty($nombre) ) {
            $this->errores['nombre'] = 'El nombre no puede estar vacío.';
        }

        $correo = trim($datos['correo'] ?? '');
        $correo = filter_var($correo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $correo || empty($correo)) {
            $this->errores['correo'] = 'El correo no puede estar vacío.';
        }
        
        $contra = trim($datos['contra'] ?? '');
        $contra = filter_var($contra, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ( ! $contra || empty($contra)) {
            $this->errores['contra'] = 'La contraseña no puede ser vacía.';
        }

        if (count($this->errores) === 0) {

            $usuario = Usuario::buscaUserPorCorreo($correo);
            
            if($usuario){
                $this->errores[] = "El correo del usuario ya esta registrado en la base de datos";
            }
            else{
                if (!$user=Usuario::inserta_user($nombre,$correo,0,$contra)){
                    $this->errores[] = "El usuario no ha podido ser insertado en la base de datos";
                }
                else{
                    $_SESSION['login']=true;
                    $_SESSION['nombre']=$user->get_nombre_usuario();
                    $_SESSION['contacto']=$user->get_contacto_usuario();
                    $_SESSION['admin']=$user->get_esAdmin_usuario();
                }
            }
                
        }
    }
}


?>