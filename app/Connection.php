<?php
namespace App;

use \PDO;

class Connection {

   
    public static function getPDO(): PDO
    {
            return $pdo = new PDO('mysql:dbname=gestionloyer;host=127.0.0.1','root','root',[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

    }
}


// tremblinluovhdb.mysql.db	
// PDO('mysql:dbname=gestionloyer;host=127.0.0.1','root','root',[
    //PDO('mysql:dbname=tremblinluovhdb;host=tremblinluovhdb.mysql.db','tremblinluovhdb',
