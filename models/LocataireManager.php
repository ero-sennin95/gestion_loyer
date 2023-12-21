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

      public function update(Locataire $locataire)
      {
         $query_str = "UPDATE locataire set nom = :name WHERE id_locataire = :id ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute(['id' => $locataire->getId_locataire(),
                              'name' => $locataire->getNom()]);
        if($ok === false){
            throw new \Exception("Impossible de mettre à jour l'enregistrement {$locataire->getId_locataire()} ", 1);
            
        }
         return $query->fetch();
      }
      public function delete(int $id)
      {
         $query_str = "DELETE locataire  WHERE id_locataire = ? ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute([$id]);
        if($ok === false){
            throw new \Exception("Impossible de supprimer l'enregistrement {$id} ", 1);
            
        }
         return $query->fetch();
      }
}