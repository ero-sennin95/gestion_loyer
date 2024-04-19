<?php

namespace App\Model;

class Locataire{
    private $id_locataire;
    private $codeLoc;	
    private $civilite;	
    private $nom;	
    private $prenom;	
    private $fixe;
    private $portable;	
    private $email;		
    private $profession;
    private $date_naissance;
    private $apl;
    private $allocation;


    
    public function __construct() {
         $this->id_locataire = -1;
         $this->codeLoc = -1;	
         $this->civilite= "";	
         $this->nom="";	
         $this->prenom="";	
         $this->fixe="";
         $this->portable="";	
         $this->email="";		
         $this->profession="";
         $this->date_naissance="";
         $this->apl="";
         $this->allocation="";
    }

    /**
     * Get the value of profession
     */ 
    public function getProfession()
    {
        return $this->profession;
    }

    /**
     * Set the value of profession
     *
     * @return  self
     */ 
    public function setProfession($profession)
    {
        $this->profession = $profession;

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
     * Get the value of codeLoc
     */ 
    public function getCodeLoc()
    {
        return $this->codeLoc;
    }

    /**
     * Set the value of codeLoc
     *
     * @return  self
     */ 
    public function setCodeLoc($codeLoc)
    {
        $this->codeLoc = $codeLoc;

        return $this;
    }

    /**
     * Get the value of civilite
     */ 
    public function getCivilite()
    {
        return $this->civilite;
    }

    /**
     * Set the value of civilite
     *
     * @return  self
     */ 
    public function setCivilite($civilite)
    {
        $this->civilite = $civilite;

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

    /**
     * Get the value of portable
     */ 
    public function getPortable()
    {
        return $this->portable;
    }

    /**
     * Set the value of portable
     *
     * @return  self
     */ 
    public function setPortable($portable)
    {
        $this->portable = $portable;

        return $this;
    }

    /**
     * Get the value of fixe
     */ 
    public function getFixe()
    {
        return $this->fixe;
    }

    /**
     * Set the value of fixe
     *
     * @return  self
     */ 
    public function setFixe($fixe)
    {
        $this->fixe = $fixe;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of date_naissance
     */ 
    public function getDate_naissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set the value of date_naissance
     *
     * @return  self
     */ 
    public function setDate_naissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    /**
     * Get the value of apl
     */ 
    public function getApl()
    {
        return $this->apl;
    }

    /**
     * Set the value of apl
     *
     * @return  self
     */ 
    public function setApl($apl)
    {
        $this->apl = $apl;

        return $this;
    }

    /**
     * Get the value of allocation
     */ 
    public function getAllocation()
    {
        return $this->allocation;
    }

    /**
     * Set the value of allocation
     *
     * @return  self
     */ 
    public function setAllocation($allocation)
    {
        $this->allocation = $allocation;

        return $this;
    }

    public function getFullName()
    {
        return $this->nom . ' ' . $this->prenom;
    }

}