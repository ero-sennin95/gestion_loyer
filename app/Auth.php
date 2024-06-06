<?php
// namespace App;

use ErrorException;

class Auth{

   public static function isConnected() :bool{
    var_dump('call is connected');
        if(session_status() === PHP_SESSION_NONE){
            var_dump('start session');
            session_start();
        }

        return !empty($_SESSION['connected']);
           // throw new ErrorException("Acces interdit");
    
    }
}