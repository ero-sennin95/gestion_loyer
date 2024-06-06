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
        return $query->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Locataire::class);
     }

     public function findAllPaginated($perPage,$offset){
      $query = $this->bdd->query("SELECT * FROM locataire ORDER BY nom DESC LIMIT $perPage OFFSET $offset");
      return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE ,Locataire::class);
   }

     public function findLocataireById(int $id){
         $query = $this->bdd->prepare("SELECT * FROM locataire WHERE id_locataire = :id");
         $query->execute(['id' => $id]);
         $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Locataire::class);
         return $query->fetch();
     }

     public function count(){
       $query = $this->bdd->query("SELECT COUNT(id_locataire) FROM locataire");
         return $query->fetch(PDO::FETCH_NUM)[0];
      }
      
      public function create(Locataire $locataire)
      {
         $query_str = "INSERT INTO locataire set nom = :lastname ,prenom = :firstname,email = :mail,date_naissance = :birthDate ,apl = :apl ";
         // $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail WHERE id_locataire = :id ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute(['lastname' => $locataire->getNom(),
                              'firstname' => $locataire->getPrenom(),
                              'mail' => $locataire->getEmail() ,
                              'birthDate' => $locataire->getDate_naissance(),
                              'apl' => $locataire->getApl()
                           ]);
         $ok = true;
        if($ok === false){
            throw new \Exception("Impossible de créer l'enregistrement {$locataire->getId_locataire()} ", 1);
            
        }
         return $query->fetch();
      }
      public function update(Locataire $locataire)
      {
         //dd($locataire);
         $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail ,date_naissance = :birthDate,apl = :apl WHERE id_locataire = :id ";
         $query = $this->bdd->prepare($query_str);
         $ok = $query->execute(['id' => $locataire->getId_locataire(),
                              'lastname' => $locataire->getNom(),
                              'firstname' => $locataire->getPrenom(),
                              'mail' => $locataire->getEmail(),
                              'birthDate' => $locataire->getDate_naissance(),
                              'apl' => $locataire->getApl()
                           ]);
        if($ok === false){
            throw new \Exception("Impossible de mettre à jour l'enregistrement {$locataire->getId_locataire()} ", 1);
            
        }
        $locataire->setId_locataire($this->bdd->lastInsertId());
         return $query->fetch();
      }

      
      public function delete(int $id)
      {
         $query_str = "DELETE FROM locataire  WHERE id_locataire = ? ";
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
         
          $query_str =("SELECT COUNT(id_locataire) FROM locataire WHERE $field = ?");
          $params = [$value];
          if($except != null){
            
            $query_str .= "AND id_locataire != ? ";
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