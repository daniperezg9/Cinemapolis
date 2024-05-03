<?php
namespace cinemapolis;
use SplFileInfo;
class FormularioModificaUsuarioAjeno extends Formulario{

    public function __construct(){
        parent::__construct('formmodifuserajeno', ['urlRedireccion' => 'index.php']);
    }

    protected function generaCamposFormulario(&$datos){

        
        $contacto=$datos['contacto'] ?? '';
        $nombre = $datos['nombre'] ?? '';
        $admin =$datos['admin'] ?? '0';
        
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['contacto', 'nombre', 'admin'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $listaUsers=Usuario::listaUserPorCorreo($_SESSION['contacto']);

        $muestraLista="<select name='contacto'><option value='nada'>Selecciona una cuenta</option>";

        while($row=$listaUsers->fetch_array()){
            $contacto=$row['contacto'];
            $muestraLista.="<option value='$contacto'>$contacto</option>";
        }

        $muestraLista.="</select>";

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Modificar el usuario de otro usuario:</legend>
            <div>
                <label for="contacto">Correo electrónico:</label>
                $muestraLista
                <p>{$erroresCampos['contacto']}</p>
            </div>
            <div>
                <label for="nombre">Nombre de usuario:</label>
                <input id="nombre" type="text" name="nombre" value="$nombre" />
                <p>{$erroresCampos['nombre']}</p>
            </div>
            <div>
                <label for="admin">Permisos de admin:</label>
                <input id="admin" type="checkbox" name="admin" value="$admin" />
                <p>{$erroresCampos['admin']}</p>
            </div>

            <button type="submit" name="Enviar">Modificar Usuario</button>
        </fieldset>
        EOF;
        return $html;
    }

    protected function procesaFormulario(&$datos){
        $this->errores = [];

        $sel= trim($datos['contacto'] ?? '');
        $sel = filter_var($sel, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($datos['contacto']==$_SESSION['contacto']){
            $this->errores['contacto']='Los administradores no deben modificar su cuenta como si fuese la de otra persona.';
        }

        
        if(!$infoUser=Usuario::buscaUserPorCorreo($datos['contacto'])){
            $this->errores['contacto']='La cuenta no tiene vinculado ningún usuario';
        }
        
        if($sel=='nada'){
            $this->errores['contacto'] = 'Debes seleccionar una cuenta.';
        }
        $nombre =       filter_var($datos['nombre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $contra =       filter_var($datos['contacto'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if(isset($_REQUEST['admin'])){
            $admin= '1';
        }
        else{
            $admin= '0';
        }
        
        
        if ( ! $nombre || empty($nombre)  ) { 
            $this->errores['nombre']='El nombre no puede ser vacío';
        }
        
        
        if ( ! $contra || empty($contra) ) {
            $this->errores['contra']='La contraseña no puede ser vacía';
        }

        if (count($this->errores) === 0) {
            
            $infoUser->set_nombre_usuario($nombre);
            $infoUser->set_esAdmin_usuario($admin);

            if(!$infoUser->modificaUser($infoUser)){
                $this->errores[]='ha sucedido un error al modificar el usuario';
            }  
            

        }      
    }
    
}


?>