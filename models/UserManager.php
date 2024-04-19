<?php


class UserManager{
    
    private $bdd;
    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }
  
     public function findAll(){
        $query = $this->bdd->query("SELECT * FROM users ORDER BY nom DESC");
        return $query->fetchAll(PDO::FETCH_CLASS,Locataire::class);
     }

     public function findByUsername(string $username){
        $query = $this->bdd->query("SELECT * FROM users WHERE username = :username");
        $query->execute(['username'=>$username]);
        $query->setFetchMode(PDO::FETCH_CLASS,User::class);
        $result =$query->fetch();
        if($result ===false){
            throw new ErrorException("Il n'y a pas d\'utilisateur");
        }
        return $result;
     }
}