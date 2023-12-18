<?php

namespace App\Model;
use \PDO;

class ContratManager{
    
    private $bdd;

    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }
  
     public function findAll(){
        $query = $this->bdd->query("SELECT * FROM contrat_location ORDER BY id_contrat_loc ");
        return $query->fetchAll(PDO::FETCH_CLASS,Contrat::class);
     }
     public function findAllPaginated($perPage,$offset){
      $query = $this->bdd->query("SELECT * FROM contrat_location ORDER BY id_contrat_loc DESC LIMIT $perPage OFFSET $offset");
      return $query->fetchAll(PDO::FETCH_CLASS,Contrat::class);
   }
     public function findContratById(int $id){
      $query = $this->bdd->prepare("SELECT * FROM contrat_location WHERE id_contrat_loc = :id");
      $query->execute(['id' => $id]);
      $query->setFetchMode(PDO::FETCH_CLASS,Contrat::class);
      return $query->fetch();
  }
     public function count()
     {
        $query = $this->bdd->query("SELECT COUNT(id_contrat_loc) FROM contrat_location");
         return $query->fetch(PDO::FETCH_NUM)[0];
     }


}