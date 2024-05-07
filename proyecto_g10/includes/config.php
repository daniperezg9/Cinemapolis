<?php 
namespace cinemapolis\src;
session_start();

spl_autoload_register(function ($class) {

    $prefix = 'cinemapolis\\';

    // base directory for the namespace prefix
    $base_dir = './includes/';


    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});


define('BD_HOST', 'localhost');
define('BD_USER', 'usuarios');
define('BD_PASS', 'usuariospass');
define('BD_NAME', 'cinemapolis');


define('RAIZ_APP', __DIR__);
define('RUTA_APP', '/cinemapolis/proyecto_g10');
define('RUTA_IMGS', RUTA_APP.'/images');
define('RUTA_CSS', RUTA_APP.'/css');
define('RUTA_JS', RUTA_APP.'/js');


ini_set('default_charset', 'UTF-8');
setLocale(LC_ALL, 'es_ES.UTF.8');
date_default_timezone_set('Europe/Madrid');


$app =Aplicacion::getInstance();
$app->init(['host'=>BD_HOST, 'bd'=>BD_NAME, 'user'=>BD_USER, 'pass'=>BD_PASS]);
register_shutdown_function([$app, 'shutdown']);
?>