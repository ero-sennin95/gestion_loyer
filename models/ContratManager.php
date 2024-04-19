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
      $query->setFetchMode(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Contrat::class);
      return $query->fetch();
  }


  public function findAllContratJoin($perPage,$offset)
  {
   $query = $this->bdd->query("SELECT cl.id_contrat_loc,cl.prov_charges,cl.loyer_mensuel,cl.caution,cl.jour_versement,cl.date_entree,cl.duree_bail,cl.notes,
                               l.nom,l.prenom
                               FROM contrat_location AS cl
                               INNER JOIN locataire AS l
                               ON cl.id_locataire = l.id_locataire
                               ORDER BY id_contrat_loc DESC LIMIT $perPage OFFSET $offset;"
                               );
        return $query->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Contrat::class);
   }

     public function count()
     {
        $query = $this->bdd->query("SELECT COUNT(id_contrat_loc) FROM contrat_location");
         return $query->fetch(PDO::FETCH_NUM)[0];
     }

   public function findLocataireById($id_loc){
      $query = $this->bdd->prepare("SELECT * FROM locataire WHERE id_locataire = :id");
      $query->execute(['id' => $id_loc]);
      $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Locataire::class);
      return $query->fetch();
   }

   public function findAllLocataires(){
      $query = $this->bdd->query("SELECT * FROM locataire ORDER BY id_locataire DESC");
      return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE ,Locataire::class);
   }

   public function findAllBiens(){
      $query = $this->bdd->query("SELECT * FROM biens ORDER BY id_bien DESC");
      return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Biens::class);
   }
   
   
   public function create(Contrat $contrat)
   {
      $query_str = "INSERT INTO contrat_location set prov_charges = :prov_charges ,loyer_mensuel = :loyer_mensuel,caution = :caution ,jour_versement = :jour_versement,date_entree = :date_entree ,
      duree_bail=:duree_bail,notes=:notes,id_locataire=:id_locataire,id_bien=:id_bien";
      // $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail WHERE id_locataire = :id ";
      $query = $this->bdd->prepare($query_str);
      $ok = $query->execute([ 'prov_charges' => $contrat->getProv_charges(),
                              'loyer_mensuel' => $contrat->getLoyer_mensuel(),
                              'caution' => $contrat->getCaution(),
                              'jour_versement' => $contrat->getJour_versement(),
                              'date_entree' => $contrat->getDate_entree(),
                              'duree_bail' => $contrat->getDuree_bail(),
                              'notes' => $contrat->getNotes(),
                              'id_locataire' => $contrat->getId_locataire(),
                              'id_bien' => $contrat->getId_bien()
                           ]);
      $ok = true;
     if($ok === false){
         throw new \Exception("Impossible de créer l'enregistrement {$contrat->getId_contrat_loc()} ", 1);
         
     }
      return $query->fetch();
   }
   
   public function update(Contrat $contrat)
   {
      //dd($locataire);
      $query_str = "UPDATE contrat_location set prov_charges = :prov_charges ,loyer_mensuel = :loyer_mensuel,caution = :caution ,jour_versement = :jour_versement,date_entree = :date_entree ,
                         duree_bail=:duree_bail,notes=:notes,id_locataire=:id_locataire,id_bien=:id_bien WHERE id_contrat_loc = :id ";
      $query = $this->bdd->prepare($query_str);
      $ok = $query->execute(['id' => $contrat->getId_contrat_loc(),
                           'prov_charges' => $contrat->getProv_charges(),
                           'loyer_mensuel' => $contrat->getLoyer_mensuel(),
                           'caution' => $contrat->getCaution(),
                           'jour_versement' => $contrat->getJour_versement(),
                           'date_entree' => $contrat->getDate_entree(),
                           'duree_bail' => $contrat->getDuree_bail(),
                           'notes' => $contrat->getNotes(),
                           'id_locataire' => $contrat->getId_locataire(),
                           'id_bien' => $contrat->getId_bien()
                        ]);
     if($ok === false){
         throw new \Exception("Impossible de mettre à jour l'enregistrement {$contrat->getId_contrat_loc()} ", 1);
         
     }
     dump($this->bdd->lastInsertId());
     //$contrat->setId_contrat_loc($this->bdd->lastInsertId());
      return $query->fetch();
   }

   public function delete(int $id)
      {
         $query_str = "DELETE FROM contrat_location  WHERE id_contrat_loc = ? ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute([$id]);
        if($ok === false){
            throw new \Exception("Impossible de supprimer l'enregistrement {$id} ", 1);
            
        }
         return $query->fetch();
      }
    /**
       * Verifie si une valeur existe en base de données
       * @param string $field Champs a rechercher
       * @param $value valeur associée au champs
       * @param $except si different de null verifie si id existe(mode edition)
       */
      public function exist(string $field,$value,?int $except=null): bool{
         
         $query_str =("SELECT COUNT(id_contrat_loc) FROM contrat_location WHERE $field = ?");
         $params = [$value];
         if($except != null){
           
           $query_str .= "AND id_contrat_loc != ? ";
           $params[] = $except;

         }
        
         $query=  $this->bdd->prepare("$query_str"); 
        //  dd($query->queryString);
         $query->execute($params);
         //$value= 'Ramos';
         //$query_str = $this->bdd->query("SELECT COUNT(id_locataire) FROM locataire WHERE nom = $value");
          return (int)$query->fetch(PDO::FETCH_NUM)[0]>0;
         //$result = $query_str->fetch(PDO::FETCH_NUM)[0];  
         }
   
}