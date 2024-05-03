<?php 
namespace cinemapolis;

class Usuario{


    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 0;

    private $contacto;
    private $nombre;
    private $esAdmin;
    private $password;
    
    public static function login($correoUsuario, $pass)
    {
        $usuario = self::buscaUserPorCorreo($correoUsuario);
        if ($usuario && $usuario->compruebaPassword($pass)) {
            return $usuario;
        }
        return false;
    }


    public static function listaUserPorCorreo($contacto){
        $conn= Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        $query = "SELECT usuarios.contacto FROM usuarios WHERE contacto != '$contacto'";
        $result = $conn->query($query);
        return $result;
    }


    public static function buscaUserPorCorreo($contacto){
        $conn= Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        $query = "SELECT * FROM usuarios WHERE contacto = '$contacto'";
        $result = $conn->query($query);
        $user=false;
        if ($result->num_rows > 0){
            $reg = $result->fetch_assoc();
            $user=new Usuario($reg['nombre'], $reg['contacto'], $reg['admin'], $reg['pass']);
            
        } 
        $result->free();
        return $user;
    }

    public static function buscaUserPorNombre($nombre){
        $conn= Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }
        $query = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
        $result = $conn->query($query);
        $user=false;
        if ($result->num_rows > 0){
            $reg = $result->fetch_assoc();    
            $user=new Usuario($reg['nombre'], $reg['contacto'], $reg['admin'], $reg['pass']);
            free($reg);
            
        } 
        free($result);
        return $user;
    }

    public static function inserta_user($nombre,$contacto,$esAdmin,$pass){
        $user=false;
        $conn= Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }

        if(self::buscaUserPorCorreo($contacto)==false){
            
            $query=sprintf("INSERT INTO usuarios(nombre, contacto, admin, pass) VALUES ('%s', '%s', '%s','%s')"
                , $conn->real_escape_string($nombre)
                , $conn->real_escape_string($contacto)
                , $conn->real_escape_string($esAdmin)
                , $conn->real_escape_string(self::hashPassword($pass))
            );
            if ( $conn->query($query) ) {
                $user = new Usuario($nombre, $contacto, $esAdmin, $pass);
                
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
        }
        return $user;
    }

    
    public static function inserta_user_admin($nombre,$contacto,$esAdmin,$pass){
        $user=false;
        $conn= Aplicacion::getInstance()->getConexionBd();
        if ($conn->connect_error){
            die("La conexión ha fallado" . $conn->connect_error);
        }

        if(self::buscaUserPorCorreo($contacto)==false){
            
            $query=sprintf("INSERT INTO usuarios(nombre, contacto, admin, pass) VALUES ('%s', '%s', '%s','%s')"
                , $conn->real_escape_string($nombre)
                , $conn->real_escape_string($contacto)
                , $conn->real_escape_string($esAdmin)
                , $conn->real_escape_string($pass)
            );
            if ( $conn->query($query) ) {
                $user = new Usuario($nombre, $contacto, $esAdmin, $pass);
                
            } else {
                error_log("Error BD ({$conn->errno}): {$conn->error}");
            }
        }
        return $user;
    }


    public static function modificaUser($user_actualizado)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query=sprintf("UPDATE usuarios U SET `nombre` = '%s', `pass`='%s', `admin`='%d' WHERE U.contacto='%s'"
            , $conn->real_escape_string($user_actualizado->nombre)
            , $conn->real_escape_string($user_actualizado->password)
            , $conn->real_escape_string($user_actualizado->esAdmin)
            , $conn->real_escape_string($user_actualizado->contacto)
        );
        if ( $conn->query($query) ) {
            $result = $user_actualizado;
        } else {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
        }
        
        return $result;
    }

    public static function borraPorCorreo($correoUsuario)
    {
        if (!$correoUsuario) {
            return false;
        } 

        $conn = Aplicacion::getInstance()->getConexionBd();

        //CHAT DE USUARIO
        $query =sprintf("DELETE FROM chat WHERE `remitente` = '%s' OR `receptor` ='s'"
        , $conn->real_escape_string($correoUsuario), $conn->real_escape_string($correoUsuario));
        $conn->query($query);

        //USUARIO EN EVENTO
        $query =sprintf("DELETE FROM usuario_en_evento WHERE `contacto` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);
        
        //EVENTOS CREADOS POR EL USUARIO
        $query =sprintf("DELETE FROM eventos WHERE `creador_evento` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);

        //ELIMINAMOS AL USER YA QUE NO EXISTE DE LA LISTA
        $query =sprintf("DELETE FROM usuario_en_foro WHERE `contacto` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);
        
        //FOROS A LOS QUE ESTA APUNTADO USUARIO
        $query =sprintf("DELETE FROM lista_foros WHERE `contacto` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);
        
        //FOROS CREADOS POR USUARIO

        $query =sprintf("DELETE FROM foro WHERE `contacto` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);

        //RESEÑAS HECHAS POR EL USUARIO
        $query =sprintf("DELETE FROM resenyas WHERE `contacto` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);

        //VALORACIONES HECHAS POR EL USUARIO
        $query =sprintf("DELETE FROM valoraciones WHERE `contacto` = '%s'"
        , $conn->real_escape_string($correoUsuario));
        $conn->query($query);


        $query = sprintf("DELETE FROM usuarios WHERE `contacto` = '%s'"
            , $conn->real_escape_string($correoUsuario)
        );
        if ( ! $conn->query($query) ) {
            error_log("Error BD ({$conn->errno}): {$conn->error}");
            return false;
        }
        return true;
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
        self::modificaUser($this);
    }

    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function compruebaPassword($password)
    {
        return password_verify($password, $this->password);
    }

    private function __construct($nombre,$contacto, $esAdministrador, $pass)
    {
        $this->contacto = $contacto;
        $this->nombre = $nombre;
        $this->password = $pass;
        $this->esAdmin = $esAdministrador;
    }

    public  function get_contacto_usuario(){
       return $this->contacto;
    }

    public  function get_nombre_usuario(){
        return $this->nombre;
    } 

    public  function get_esAdmin_usuario(){
        return $this->esAdmin;
    }

    public  function get_password_usuario(){
        return $this->password;
    }

    /* 
    public  function set_contacto_usuario(){
        return $this->contacto;
     }
    */
     public function set_nombre_usuario($nombre){
        $this->nombre =$nombre;
     } 
 
     public function set_esAdmin_usuario($esAdmin){
        $this->esAdmin = $esAdmin;
     }
 
     public function set_password_usuario($pass){
        $this->password=self::hashPassword($pass);
     }
 
  
}


