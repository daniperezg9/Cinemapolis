<?php
namespace cinemapolis;
use SplFileInfo;
class FormularioModificaUsuarioPropio extends Formulario{

    public function __construct(){
        parent::__construct('formmodifuserpropio', ['urlRedireccion' => 'index.php']);
    }

    protected function generaCamposFormulario(&$datos){

        
        $contacto=$_SESSION['contacto'];
        $nombre = $datos['nombre'] ?? $_SESSION['nombre'];
        $contra = $datos['contra'] ?? '';
        
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['nombre', 'contra'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Modifica el usuario con cuenta: $contacto.</legend>
            <div>
                <label for="nombre">Nombre de usuario:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                <p>{$erroresCampos['nombre']}</p>
            </div>
            <div>
                <label for="contra">Contraseña nueva:</label>
                <input id="contra" type="password" name="contra" value="$contra" />
                <p>{$erroresCampos['contra']}</p>
            </div>

            <button type="submit" name="Enviar">Modificar Usuario</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos){
        $this->errores = [];

        $infoUser=Usuario::buscaUserPorCorreo($_SESSION['contacto']);
        
        $nombre =       filter_var($datos['nombre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contra =       filter_var($datos['contra'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        if ( ! $nombre || empty($nombre)  ) { 
            $this->errores['nombre']='El nombre no puede ser vacío';
        }
        
        
        if ( ! $contra || empty($contra) ) {
            $this->errores['contra']='La contraseña no puede ser vacía';
        }

        if (count($this->errores) === 0) {
            
            $infoUser->set_nombre_usuario($nombre);
            $infoUser->set_password_usuario($contra);

            if(!$infoUser->modificaUser($infoUser)){
                $this->errores[]='ha sucedido un error al modificar el usuario';
            }  
            

        }      
    }
    
}


?>