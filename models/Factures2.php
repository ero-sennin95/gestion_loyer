<?php
namespace App\Model;

use App\Model\Ligne;


class Factures2{

    //Default table field
    private $id_facture;
    private $date_debut;
    private $date_fin;
    private $date_emission;
    private $montant_fact;
    private $description_ligne;
    private $tva_ligne;
    //Foreign key
    private $id_type_fact;
    private $id_contrat_loc;


    //external data
    private $nom_type_fact;
    private $nameId; //name of contrat in table contrat_loc
    private $nom_bien; //name of the bien in table biens
    private $payeur; //name of the payeur in table payeur

    private $montant_regl; //Sum of all reglements in table lign_regl

    
    private $date_regl;
    
    
    
    private$prenom;
    private $type_Biens;
   

    //Foreign keys
    
  

    

    public function __construct() {
        $this->id_facture = -1;
        $this->date_emission = "1990/01/01";
        $this->date_debut = "00/00/0000" ;
        $this->date_fin ="00/00/0000" ;
        $this->date_regl = "00/00/0000";
        $this->montant_fact = 0;
        $this->description_ligne = "Description du paiement par defaut";
        $this->tva_ligne = 0;
        //fk
        $this->id_type_fact = -1;
        $this->id_contrat_loc =-1;

        //external data
        $this->nom_type_fact = "Not defined"; //type de facture loyer,assurance.... table(type_fact)
        $this->nameId = ""; //
        $this->payeur = "";
        $this->montant_regl = 0;
            
        $this->nom_bien = "";
        $this->prenom ="";
        
        $this->type_Biens = "";

       }

 


    /**
     * Get the value of nameId
     */ 
    public function getNameId()
    {
        return $this->nameId;
    }

    /**
     * Get the value of date_emission
     */ 
    public function getDate_emission()
    {
        return $this->date_emission;
    }

    /**
     * Get the value of montant_fact
     */ 
    public function getMontant_fact()
    {
        return $this->montant_fact;
    }

    /**
     * Get the value of description_ligne
     */ 
    public function getDescription_ligne()
    {
        return $this->description_ligne;
    }

    /**
     * Get the value of nom_type_fact
     */ 
    public function getNom_type_fact()
    {
        return $this->nom_type_fact;
    }

   
    /**
     * Set the value of date_emission
     *
     * @return  self
     */ 
    public function setDate_emission($date_emission)
    {
        $this->date_emission = $date_emission;

        return $this;
    }

    /**
     * Set the value of montant_fact
     *
     * @return  self
     */ 
    public function setMontant_fact($montant_fact)
    {
        $this->montant_fact = $montant_fact;

        return $this;
    }

    /**
     * Set the value of description_ligne
     *
     * @return  self
     */ 
    public function setDescription_ligne($description_ligne)
    {
        $this->description_ligne = $description_ligne;

        return $this;
    }

    /**
     * Set the value of nom_type_fact
     *
     * @return  self
     */ 
    public function setNom_type_fact($nom_type_fact)
    {
        $this->nom_type_fact = $nom_type_fact;

        return $this;
    }

    /**
     * Set the value of id_type_fact
     *
     * @return  self
     */ 
    public function setId_type_fact($id_type_fact)
    {
        $this->id_type_fact = $id_type_fact;

        return $this;
    }

    /**
     * Get the value of id_type_fact
     */ 
    public function getId_type_fact()
    {
        return $this->id_type_fact;
    }

    /**
     * Set the value of nameId
     *
     * @return  self
     */ 
    public function setNameId($nameId)
    {
        $this->nameId = $nameId;

        return $this;
    }

    /**
     * Set the value of id_contrat_loc
     *
     * @return  self
     */ 
    public function setId_contrat_loc($id_contrat_loc)
    {
        $this->id_contrat_loc = $id_contrat_loc;

        return $this;
    }

    /**
     * Get the value of id_contrat_loc
     */ 
    public function getId_contrat_loc()
    {
        return $this->id_contrat_loc;
    }

    /**
     * Get the value of id_facture
     */ 
    public function getId_facture()
    {
        return $this->id_facture;
    }

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
    }

    /**
     * Get the value of date_fin
     */ 
    public function getDate_fin()
    {
        return $this->date_fin;
    }

    /**
     * Get the value of nom_bien
     */ 
    public function getNom_bien()
    {
        return $this->nom_bien;
    }

    /**
     * Get the value of payeur
     */ 
    public function getPayeur()
    {
        return $this->payeur;
    }

    /**
     * Get the value of montant_regl
     */ 
    public function getMontant_regl()
    {
        return $this->montant_regl;
    }

    /**
     * Set the value of montant_regl
     *
     * @return  self
     */ 
    public function setMontant_regl($montant_regl)
    {
        $this->montant_regl = $montant_regl;

        return $this;
    }

    /**
     * Get the value of tva_ligne
     */ 
    public function getTva_ligne()
    {
        return $this->tva_ligne;
    }

    /**
     * Set the value of date_debut
     *
     * @return  self
     */ 
    public function setDate_debut($date_debut)
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    /**
     * Set the value of date_fin
     *
     * @return  self
     */ 
    public function setDate_fin($date_fin)
    {
        $this->date_fin = $date_fin;

        return $this;
    }
}