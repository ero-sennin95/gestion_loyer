<?php
namespace App\Model;

use App\Model\Ligne;


class Factures2{

    private $id_facture;
    private $date_emission;
    private $montant_fact;
    private $montant_regl;
    private $date_regl;
    private $type_ligne;
    private $id_contrat_loc;
    private $nom_bien;
    private $payeur;
    private$prenom;
    private $type_Biens;
  

    

    public function __construct() {
        $this->id_facture = -1;
        $this->date_emission = "1990/01/01";
        $this->date_regl = "00/00/0000";
        $this->montant_fact = 0;
        $this->montant_regl = 0;
        $this->type_ligne = "Not defined";
        $this->id_contrat_loc =-1;
        $this->nom_bien = "";
        $this->prenom ="";
        $this->payeur = array();
        $this->type_Biens = "";
       
       }

 

    /**
     * Get the value of id_facture
     */ 
    public function getId_facture()
    {
        return $this->id_facture;
    }

    /**
     * Set the value of id_facture
     *
     * @return  self
     */ 
    public function setId_facture($id_facture)
    {
        $this->id_facture = $id_facture;

        return $this;
    }

    /**
     * Get the value of date_emission
     */ 
    public function getDate_emission()
    {
        return $this->date_emission;
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
     * Get the value of montant_fact
     */ 
    public function getMontant_fact()
    {
        return $this->montant_fact;
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
     * Get the value of date_regl
     */ 
    public function getDate_regl()
    {
        return $this->date_regl;
    }

    /**
     * Set the value of date_regl
     *
     * @return  self
     */ 
    public function setDate_regl($date_regl)
    {
        $this->date_regl = $date_regl;

        return $this;
    }

    /**
     * Get the value of type_ligne
     */ 
    public function getType_ligne()
    {
        return $this->type_ligne;
    }

    /**
     * Set the value of type_ligne
     *
     * @return  self
     */ 
    public function setType_ligne($type_ligne)
    {
        $this->type_ligne = $type_ligne;

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
     * Get the value of nom_bien
     */ 
    public function getNomBien()
    {
        return $this->nom_bien;
    }

    /**
     * Set the value of nom_bien
     *
     * @return  self
     */ 
    public function setNomBien($nom_bien)
    {
        $this->nom_bien = $nom_bien;

        return $this;
    }

    /**
     * Get the value of payeur
     */ 
    public function getPayeur()
    {
        return $this->payeur;
    }

    /**
     * Set the value of payeur
     *
     * @return  self
     */ 
    public function setPayeur($payeur)
    {
        $this->payeur = $payeur;

        return $this;
    }
}