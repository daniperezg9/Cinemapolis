<?php 
namespace cinemapolis;

class Admin{
 
    public static function esAdmin($app) {
        return isset($_SESSION['admin']) && $_SESSION['admin'];
    }
}


