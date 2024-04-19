<?php

namespace App\Model;

use DateTime;

class Contrat{
    private $id_contrat_loc;
    private $nameId;    //Must be set in database request cf contrats/create.php
    private $prov_charges;
    private $loyer_mensuel;
    private $caution;
    private $jour_versement;
    private $date_entree;
    private $duree_bail;
    private $notes;
    private $id_locataire;
    private $id_bien;
    // Foreign keys
    private $nom;
    private $prenom;

    public function __construct() {
        $this->nameId = "";
        $this->id_contrat_loc = -1;
        $this->prov_charges = 0;
        $this->loyer_mensuel = 0;	
        $this->caution= 0;	
        $this->jour_versement=0;	
        $this->date_entree=date("Y-m-d");	
        $this->duree_bail=0;
        $this->notes="";	
        $this->id_locataire=-1;		
        $this->id_bien=-1;
       
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
     * Get the value of prov_charges
     */ 
    public function getProv_charges()
    {
        return $this->prov_charges;
    }

    /**
     * Set the value of prov_charges
     *
     * @return  self
     */ 
    public function setProv_charges($prov_charges)
    {
        $this->prov_charges = $prov_charges;

        return $this;
    }

    /**
     * Get the value of loyer_mensuel
     */ 
    public function getLoyer_mensuel()
    {
        return $this->loyer_mensuel;
    }

    /**
     * Set the value of loyer_mensuel
     *
     * @return  self
     */ 
    public function setLoyer_mensuel($loyer_mensuel)
    {
        $this->loyer_mensuel = $loyer_mensuel;

        return $this;
    }

    /**
     * Get the value of caution
     */ 
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * Set the value of caution
     *
     * @return  self
     */ 
    public function setCaution($caution)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get the value of duree_bail
     */ 
    public function getDuree_bail()
    {
        return $this->duree_bail;
    }

    /**
     * Set the value of duree_bail
     *
     * @return  self
     */ 
    public function setDuree_bail($duree_bail)
    {
        $this->duree_bail = $duree_bail;

        return $this;
    }

    /**
     * Get the value of notes
     */ 
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set the value of notes
     *
     * @return  self
     */ 
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get the value of id_locataire
     */ 
    public function getId_locataire()
    {
        return $this->id_locataire;
    }

    /**
     * Set the value of id_locataire
     *
     * @return  self
     */ 
    public function setId_locataire($id_locataire)
    {
        $this->id_locataire = $id_locataire;

        return $this;
    }

    /**
     * Get the value of id_bien
     */ 
    public function getId_bien()
    {
        return $this->id_bien;
    }

    /**
     * Set the value of id_bien
     *
     * @return  self
     */ 
    public function setId_bien($id_bien)
    {
        $this->id_bien = $id_bien;

        return $this;
    }

    /**
     * Get the value of jour_versement
     */ 
    public function getJour_versement()
    {
        return $this->jour_versement;
    }

    /**
     * Set the value of jour_versement
     *
     * @return  self
     */ 
    public function setJour_versement($jour_versement)
    {
        $this->jour_versement = $jour_versement;

        return $this;
    }

    /**
     * Get the value of date_entree
     */ 
    public function getDate_entree()
    {
        return $this->date_entree;
    }

    /**
     * Set the value of date_entree
     *
     * @return  self
     */ 
    public function setDate_entree($date_entree)
    {
        $this->date_entree = $date_entree;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getFullName()
    {
        return $this->getNom().' '  . $this->getPrenom();
    }

    /**
     * Get the value of nameId
     */ 
    public function getNameId()
    {
        return $this->nameId;
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
}
