<?php
namespace App\Model;
use \PDO;

class LocataireManager{

    private $bdd;

    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }
  
     public function findAll(){
        $query = $this->bdd->query("SELECT * FROM locataire ORDER BY nom DESC");
        return $query->fetchAll(PDO::FETCH_CLASS,Locataire::class);
     }

     public function findAllPaginated($perPage,$offset){
      $query = $this->bdd->query("SELECT * FROM locataire ORDER BY nom DESC LIMIT $perPage OFFSET $offset");
      return $query->fetchAll(PDO::FETCH_CLASS,Locataire::class);
   }

     public function findLocataireById(int $id){
         $query = $this->bdd->prepare("SELECT * FROM locataire WHERE id_locataire = :id");
         $query->execute(['id' => $id]);
         $query->setFetchMode(PDO::FETCH_CLASS,Locataire::class);
         return $query->fetch();
     }

     public function count(){
       $query = $this->bdd->query("SELECT COUNT(id_locataire) FROM locataire");
         return $query->fetch(PDO::FETCH_NUM)[0];
      }

}