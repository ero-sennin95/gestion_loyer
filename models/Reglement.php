<?php
namespace App\Model;

class Reglement{
    
    private $id_ligne_regl;
    private $date_regl;
    private $montant_regl;
    private $description_regl;
    private $id_facture;
    private $id_payeur;
    
    private $total_credit;


    public function __construct(){
         $this->id_ligne_regl = -1;
         $this->date_regl = date('Y-m-d');
         $this->montant_regl =0;
        $this->id_payeur = -1;
        $this->description_regl= "";
         //Foreign key
         $this->id_facture=-1;
    
    }


    /**
     * Get the value of date_regl
     */ 
    public function getDateReglement()
    {
        return $this->date_regl;
    }

    /**
     * Set the value of date_regl
     *
     * @return  self
     */ 
    public function setDateReglement($date_regl)
    {
        $this->date_regl = $date_regl;

        return $this;
    }

    /**
     * Get the value of montat
     */ 
    public function getMontantRegl()
    {
        return $this->montant_regl;
    }

    /**
     * Set the value of montat
     *
     * @return  self
     */ 
    public function setMontantRegl($montat)
    {
        $this->montant_regl = $montat;

        return $this;
    }

    /**
     * Get the value of id_facture
     */ 
    public function getIdFacture()
    {
        return $this->id_facture;
    }

    /**
     * Set the value of id_facture
     *
     * @return  self
     */ 
    public function setIdFacture($id_facture)
    {
        $this->id_facture = $id_facture;

        return $this;
    }

    /**
     * Get the value of id_ligne_regl
     */ 
    public function getIdReglement()
    {
        return $this->id_ligne_regl;
    }

    /**
     * Set the value of id_ligne_regl
     *
     * @return  self
     */ 
    public function setIdReglement($id_ligne_regl)
    {
        $this->id_ligne_regl = $id_ligne_regl;

        return $this;
    }

    

    /**
     * Get the value of total_credit
     */ 
    public function getcredit_total()
    {
        return $this->total_credit;
    }

    /**
     * Set the value of total_credit
     *
     * @return  self
     */ 
    public function setcredit_total($total_credit)
    {
        $this->total_credit = $total_credit;

        return $this;
    }

    /**
     * Get the value of id_payeur
     */ 
    public function getid_payeur()
    {
        return $this->id_payeur;
    }

    /**
     * Set the value of id_payeur
     *
     * @return  self
     */ 
    public function setid_payeur($id_payeur)
    {
        $this->id_payeur = $id_payeur;

        return $this;
    }

    /**
     * Get the value of description_regl
     */ 
    public function getDescription_regl()
    {
        return $this->description_regl;
    }

    /**
     * Set the value of description_regl
     *
     * @return  self
     */ 
    public function setDescription_regl($description_regl)
    {
        $this->description_regl = $description_regl;

        return $this;
    }
}