<?php
namespace App\Model;
use \PDO;

class ReglementManager{

    private $bdd;

    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }

     public function findAllReglement(){
        $query = $this->bdd->query("SELECT * FROM ligne_regl ORDER BY id_reglement DESC");
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Reglement::class);
     }
     public function findReglementById(int $id_regl){
      $query = $this->bdd->prepare("SELECT * FROM ligne_regl WHERE id_ligne_regl = :idregl");
      $query->execute(['idregl' => $id_regl]);
      $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Reglement::class);
      return $query->fetch();
   }

     public function findAllPayeur(){
      $query = $this->bdd->query("SELECT * FROM payeur ORDER BY id_payeur ASC");
      return $query->fetchAll(PDO::FETCH_OBJ);
   }

     public function findReglementByFacureId(int $id){
      $query_str = $this->bdd->prepare("SELECT * FROM ligne_regl WHERE id_facture = :id");
      $query_str->execute(['id' => $id]);
      $query_str->setFetchMode(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Reglement::class);
      return $query_str->fetchAll();

     // return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Reglement::class);
   }
     //TODO
     public function sumReglementById($idFacture){
        $query = $this->bdd->query("SELECT SUM(montant) FROM reglement WHERE id_facture = :id_facture");
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Reglement::class);
     }

     public function sumReglement(){
        $query = $this->bdd->query("SELECT id_facture,SUM(montant) AS total_credit FROM reglement
        GROUP BY id_facture;");
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Reglement::class);
     }

     

     public function create(Reglement $reglement)
     {
        $query_str = "INSERT INTO ligne_regl set date_regl = :date , montant_regl = :montant,description_regl = :description , id_payeur=:payeur ,id_facture = :id_facture";
        // $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail WHERE id_locataire = :id ";
        $query = $this->bdd->prepare($query_str);
        $ok = $query->execute(['date' => $reglement->getDateReglement(),
                             'montant' => $reglement->getMontantRegl(),
                             'id_facture' => $reglement->getIdFacture() ,
                             'description' =>$reglement->getDescription_regl(),
                             'payeur' => 1
                          ]);
        $ok = true;
       if($ok === false){
           throw new \Exception("Impossible de créer l'enregistrement {$reglement->getIdReglement()} ", 1);
           
       }

        return $query->fetch();
     }

     public function delete(int $id)
      {
         $query_str = "DELETE FROM ligne_regl  WHERE id_ligne_regl = ? ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute([$id]);
        if($ok === false){
            throw new \Exception("Impossible de supprimer l'enregistrement {$id} ", 1);
            
        }
         return $query->fetch();
      }

      public function update(reglement $reglement)
      {
         //dd($locataire);
         dump($reglement);
         $query_str = "UPDATE ligne_regl set montant_regl = :montant ,date_regl = :date, description_regl = :description WHERE id_ligne_regl = :id ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute(['montant' => $reglement->getMontantRegl(),
                              'date' => $reglement->getDateReglement(),
                              'description' => $reglement->getDescription_regl(),
                              'id' =>$reglement->getIdReglement()
                           ]);
        if($ok === false){
            throw new \Exception("Impossible de mettre à jour l'enregistrement {$reglement->getIdReglement()} ", 1);
            
        }
        $reglement->setIdReglement($this->bdd->lastInsertId());
         return $query->fetch();
      }
}

