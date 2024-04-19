<?php

namespace App\Model;

class Ligne{
    private $id_ligne;
    private $montant_ligne;
    private $tva_ligne;
    private $type_ligne ;
    

    //foreign_key
    private $id_facture;

    public function __construct()
    {
        $this->id_ligne=-1;
        $this->montant_ligne=0;
        $this->tva_ligne=0;
        $this->type_ligne='Divers';
    }
    /**
     * Get the value of id_ligne
     */ 
    public function getId_ligne()
    {
        return $this->id_ligne;
    }

    /**
     * Set the value of id_ligne
     *
     * @return  self
     */ 
    public function setId_ligne($id_ligne)
    {
        $this->id_ligne = $id_ligne;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant_ligne;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant_ligne = $montant;

        return $this;
    }

    /**
     * Get the value of tva
     */ 
    public function getTva()
    {
        return $this->tva_ligne;
    }

    /**
     * Set the value of tva
     *
     * @return  self
     */ 
    public function setTva($tva)
    {
        $this->tva_ligne = $tva;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type_ligne;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type_ligne = $type;

        return $this;
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
}
