<?php
namespace App\Model;
use \PDO;

class ReglementManager{

    private $bdd;

    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }

     public function findAllReglement(){
        $query = $this->bdd->query("SELECT * FROM reglement ORDER BY id_reglement DESC");
        return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Reglement::class);
     }


     public function findReglementByFacureId(int $id){
      $query_str = $this->bdd->prepare("SELECT * FROM reglement WHERE id_facture = :id");
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
        $query_str = "INSERT INTO reglement set date = :date , montant = :montant , id_payeur=:payeur ,id_facture = :id_facture";
        // $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail WHERE id_locataire = :id ";
        $query = $this->bdd->prepare($query_str);
        $ok = $query->execute(['date' => $reglement->getDate(),
                             'montant' => $reglement->getMontant(),
                             'id_facture' => $reglement->getIdFacture() ,
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
         $query_str = "DELETE FROM reglement  WHERE id_reglement = ? ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute([$id]);
        if($ok === false){
            throw new \Exception("Impossible de supprimer l'enregistrement {$id} ", 1);
            
        }
         return $query->fetch();
      }
}

