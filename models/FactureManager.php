<?php

namespace App\Model;
use \PDO;
class FactureManager{
    private $bdd;

    public function __construct(){
        $this->bdd =  \App\Connection::getPDO();
     }
  
   
   public function findligneByFactureId($id){
      $query = $this->bdd->prepare("SELECT * FROM ligne WHERE id_facture = :id");
      $query->execute(['id' => $id]);
      $query->setFetchMode(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Ligne::class);
      return $query->fetchAll();
   }

   public function findAllFacture2(){
      $query = $this->bdd->query("SELECT  fa.id_facture,fa.date_emission,fa.id_contrat_loc,
      biens.nom AS nom_bien,biens.type_Biens
      FROM facture as fa
      JOIN contrat_location AS cl
      ON fa.id_contrat_loc = cl.id_contrat_loc
      JOIN biens
      ON biens.id_bien = cl.id_bien
      ORDER BY fa.id_facture DESC;");
      return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Factures2::class);
   }

   public function findPayeur(int $id)
   {
     $query = $this->bdd->query("SELECT * FROM ligne_regl
               JOIN payeur
               ON ligne_regl.id_payeur = payeur.id_payeur
                WHERE id_facture = $id");
      return $query->fetchAll(PDO::FETCH_OBJ);
      ;
   }
   public function findTotalFacture(){
      $query = $this->bdd->query("SELECT 
      fac.id_facture,fac.date_emission,
      SUM(lfac.montant_ligne) AS montant_fact,lfac.type_ligne,
      SUM(lreg.montant_regl)AS montant_regl,lreg.date_regl
      FROM `facture` AS fac
      JOIN ligne_fact AS lfac
      ON fac.id_facture=lfac.id_facture
      JOIN ligne_regl AS lreg
      ON fac.id_facture = lreg.id_facture
      GROUP BY fac.id_facture;");
     return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Factures2::class);
   }
  
   /*
   Get total for a $col
   param: $col
   */
   public function sumBycolWithId(string $table,string $col,int $id)
   {
      $param = "";
      if($table === 'ligne_fact'){
         $param = "montant_fact";
      }else if($table === 'ligne_regl'){
         $param = "montant_regl";
      }
      
      $query = $this->bdd->prepare("SELECT SUM($col) AS $param FROM $table WHERE id_facture = :id");
      $query->execute(['id' => $id]);
      return $query->fetch(PDO::FETCH_OBJ);
     // return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Factures2::class);   
   }


   public function findAllLocataireWithContrat(){
      $query = $this->bdd->query("SELECT DISTINCT loc.nom,loc.prenom FROM contrat_location AS cl 
      JOIN locataire AS loc
      ON cl.id_locataire = loc.id_locataire;");
      return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Contrat::class);
   }

   public function findAllContrat(){
      $query = $this->bdd->query("SELECT * FROM contrat_location ");
      return $query->fetchAll(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE,Contrat::class);
   }

   public function findFactureById(int $id){
      $query = $this->bdd->prepare("SELECT * FROM facture WHERE id_facture = :id");
      $query->execute(['id' => $id]);
      $query->setFetchMode(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE,Factures::class);
      return $query->fetch();
  }


   //IINSERT INTO `facture`(`id_facture`, `mois`, `annee`, `date_emission`, `montant`, `moisannee`, `id_contrat_loc`) 
   //VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]')
   public function create(Factures $facture)
   {
      $query_str = "INSERT INTO facture set date_debut = :date_debut ,date_fin = :date_fin,date_emission = :date_emission ,montant = :montant,
      id_contrat_loc=:id_contrat_loc";
      // $query_str = "UPDATE locataire set nom = :lastname ,prenom = :firstname,email = :mail WHERE id_locataire = :id ";
      $query = $this->bdd->prepare($query_str);
      $ok = $query->execute([ 'date_debut' => $facture->getDate_debut(),
                              'date_fin' => $facture->getDate_fin(),
                              'date_emission' => $facture->getDate_emission(),
                              'montant' => $facture->getMontant(),
                              'id_contrat_loc' => $facture->getId_contrat_loc()
                           ]);
      $ok = true;
     if($ok === false){
         throw new \Exception("Impossible de créer l'enregistrement {$facture->getId_facture()} ", 1);
         
     }
      return $query->fetch();
   }

   public function update(Factures $facture)
   {
      //dd($locataire);
      $query_str = "UPDATE facture  set date_debut = :date_debut ,date_fin = :date_fin,date_emission = :date_emission ,montant = :montant,
                                 id_contrat_loc=:id_contrat_loc WHERE id_facure = :id ";
      $query = $this->bdd->prepare($query_str);
      $ok = $query->execute(['id' => $facture->getId_facture(),
                              'date_debut' => $facture->getDate_debut(),
                              'date_fin' => $facture->getDate_fin(),
                              'date_emission' => $facture->getDate_emission(),
                              'montant' => $facture->getMontant(),
                              'id_contrat_loc' => $facture->getId_contrat_loc()
                        ]);
     if($ok === false){
         throw new \Exception("Impossible de mettre à jour l'enregistrement {$facture->getId_facture()} ", 1);
         
     }
     dump($this->bdd->lastInsertId());
     //$contrat->setId_contrat_loc($this->bdd->lastInsertId());
      return $query->fetch();
   }

   public function delete(int $id)
      {
         $query_str = "DELETE FROM facture  WHERE id_facure = ? ";
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
         
         $query_str =("SELECT COUNT(id_facure) FROM facture WHERE $field = ?");
         $params = [$value];
         if($except != null){
           
           $query_str .= "AND id_facure != ? ";
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