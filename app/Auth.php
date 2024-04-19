<?php
namespace App;

use ErrorException;

class Auth{
    public static function check(){
        if(true){

        }else{
            throw new ErrorException("Acces interdit");
        }
    }
}