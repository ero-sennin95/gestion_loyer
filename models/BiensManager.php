<?php

namespace App\Model;
use \PDO;

class BiensManager{
    private $bdd;

    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }
  
   
     public function findAll(){
        $query = $this->bdd->query("SELECT * FROM biens ");
        return $query->fetchAll(PDO::FETCH_CLASS,Biens::class);
     }

     public function findBienById(int $id){
      $query = $this->bdd->prepare("SELECT * FROM biens WHERE id_bien = :id");
      $query->execute(['id' => $id]);
      $query->setFetchMode(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Biens::class);
      return $query->fetch();
  }


     public function findAllContratJoin($perPage,$offset)
  {
   $query = $this->bdd->query("SELECT b.id_bien,b.nom,b.adresse1,b.id_contrat_loc ,b.type_Biens,b.ville,
                     cl.id_contrat_loc,cl.id_locataire,
                     loc.nom AS nom_loc,loc.prenom AS prenom_loc
                     FROM biens AS b
                     LEFT JOIN contrat_location AS cl
                     ON b.id_contrat_loc = cl.id_contrat_loc
                     LEFT JOIN locataire AS loc	
                     ON cl.id_locataire=loc.id_locataire
                             ");           //TODO FAUXXXXX pas id_contrat_loc
        return $query->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Biens::class);
   }

   public function create(Biens $bien)
   {
      $query_str = "INSERT INTO biens SET nom = :nom ,type_Biens = :type,adresse1 = :adresse1,adresse2 = :adresse2 ,ville = :ville,cp=:cp,description=:description ";
      // $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail WHERE id_locataire = :id ";
      $query = $this->bdd->prepare($query_str);
      $ok = $query->execute(['nom' => $bien->getNom(),
                           'type' => $bien->getType_biens(),
                           'adresse1' => $bien->getAdresse1() ,
                           'adresse2' => $bien->getAdresse2(),
                           'ville' =>$bien->getVille(),
                           'cp' => $bien->getCp(),
                           'description' => $bien->getDescription()
                        ]);
      $ok = true;
     if($ok === false){
         throw new \Exception("Impossible de créer l'enregistrement {$bien->getId_bien()} ", 1);
         
     }
      return $query->fetch();
   }
   public function update(Biens $bien)
   {
      //dd($locataire);
      $query_str = "UPDATE biens SET nom = :nom ,type_Biens = :type_Biens,adresse1 = :adresse1,adresse2 = :adresse2 ,ville = :ville,cp=:cp,description=:description WHERE id_bien = :id ";
      $query = $this->bdd->prepare($query_str);
      $ok = $query->execute([ 'id' => $bien->getId_bien(),
                              'nom' => $bien->getNom(),
                              'type_Biens' => $bien->getType_biens(),
                              'adresse1' => $bien->getAdresse1() ,
                              'adresse2' => $bien->getAdresse2(),
                              'ville' =>$bien->getVille(),
                              'cp' => $bien->getCp(),
                              'description' => $bien->getDescription()
                        ]);
     if($ok === false){
         throw new \Exception("Impossible de mettre à jour l'enregistrement {$bien->getId_bien()} ", 1);
         
     }
     //$bien->setId_bien($this->bdd->lastInsertId());
      return $query->fetch();
   }
   public function delete(int $id)
   {
      $query_str = "DELETE FROM biens  WHERE id_bien = ? ";
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
         
         $query_str =("SELECT COUNT(id_bien) FROM biens WHERE $field = ?");
         $params = [$value];
         if($except != null){
           
           $query_str .= "AND id_bien != ? ";
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