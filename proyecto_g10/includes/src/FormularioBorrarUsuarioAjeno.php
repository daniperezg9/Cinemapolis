<?php
namespace cinemapolis\src;

class FormularioBorrarUsuarioAjeno extends Formulario{

    public function __construct(){
        parent::__construct('formborrauserajeno', ['urlRedireccion' => 'index.php', 'enctype' => 'multipart/form-data']);
    }

    protected function generaCamposFormulario(&$datos){

        $conf = '';
        $sel='';
        $htmlErroresGlobales = self::generaListaErroresGlobales($this->errores);
        $erroresCampos = self::generaErroresCampos(['conf','sel'],
                                                    $this->errores, 'span', array('class' => 'error'));
        

        $correo=$_SESSION['contacto'];

        $listaUsers=Usuario::listaUserPorCorreo($correo); //no queremos que un admin pueda borrar su propia cuenta

        $muestraLista="<select name='sel'><option value='nada'>Selecciona una cuenta</option>";

        foreach($listaUsers as $row){
            $contacto=$row->get_contacto_usuario();
            $muestraLista.="<option value='$contacto'>$contacto</option>";
        }

        $muestraLista.="</select>";

        $html = <<<EOF
        $htmlErroresGlobales
        <fieldset>
            <legend>Borrar el usuario de la cuenta:</legend>
            <div>
                <label for="sel">Correo a borrar:</label>
                $muestraLista
                <p>{$erroresCampos['sel']}</p>
                <p>Escribe el correo seleccionado para borrar la cuenta</p>
                <label for="conf">Confirmación:</label>
                <input id="conf" type="text" name="conf" value="$conf" />
                <p>{$erroresCampos['conf']}</p>
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


        $sel= trim($datos['sel'] ?? '');
        $sel = filter_var($sel, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        

        if($sel=='nada'){
            $this->errores['sel'] = 'Debes seleccionar una cuenta.';
        }
        else{
            if($conf != $sel){
                $this->errores['conf'] = 'La confirmación no corresponde con la cuenta.';
            }
        }

        if (count($this->errores) === 0){

            $usuario = Usuario::buscaUserPorCorreo($datos['sel']);
            
            if(!$usuario){
                $this->errores[] = "Este correo [ $conf ] no deberia estar vinculado a la cuenta $sel.";
            }
            else{
                if (!Usuario::borraPorCorreo($datos['sel'])){
                    $this->errores[] = "El usuario no ha podido ser borrado en la base de datos";
                }
                
            }
                
        }
    }
}


?>