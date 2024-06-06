<?php

namespace App\Model;

class Ligne{
    private $id_ligne_regl;
    private $montant_regl;
    private $tva_regl;
    private $type_regl ;
    private $date_regl;
    private $description_regl;
    

    //foreign_key
    private $id_facture;
    private $id_payeur;

    public function __construct()
    {
        $this->id_ligne_regl=-1;
        $this->montant_regl=0;
        $this->tva_regl=0;
        $this->type_regl='Divers';
        $this->date_regl = '00/00/0000';
        $this->description_regl = "Reglement par defaut";
        $this->id_facture = -1;
        $this->id_payeur =-1;
    }
    /**
     * Get the value of id_ligne_regl
     */ 
    public function getId_ligne()
    {
        return $this->id_ligne_regl;
    }

    /**
     * Set the value of id_ligne_regl
     *
     * @return  self
     */ 
    public function setId_ligne($id_ligne_regl)
    {
        $this->id_ligne_regl = $id_ligne_regl;

        return $this;
    }

    /**
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant_regl;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant_regl = $montant;

        return $this;
    }

    /**
     * Get the value of tva
     */ 
    public function getTva()
    {
        return $this->tva_regl;
    }

    /**
     * Set the value of tva
     *
     * @return  self
     */ 
    public function setTva($tva)
    {
        $this->tva_regl = $tva;

        return $this;
    }

    /**
     * Get the value of type
     */ 
    public function getType()
    {
        return $this->type_regl;
    }

    /**
     * Set the value of type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type_regl = $type;

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
