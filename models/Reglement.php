<?php
namespace App\Model;

class Reglement{
    
    private $id_reglement;
    private $date;
    private $montant;
    private $id_facture;
    private $id_payeur;
    private $total_credit;


    public function __construct(){
         $this->id_reglement = -1;
         $this->date = date('Y-m-d');
         $this->montant =0;
        $this->id_payeur = -1;
         //Foreign key
         $this->id_facture=-1;
    
    }


    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of montat
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montat
     *
     * @return  self
     */ 
    public function setMontant($montat)
    {
        $this->montant = $montat;

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
     * Get the value of id_reglement
     */ 
    public function getIdReglement()
    {
        return $this->id_reglement;
    }

    /**
     * Set the value of id_reglement
     *
     * @return  self
     */ 
    public function setIdReglement($id_reglement)
    {
        $this->id_reglement = $id_reglement;

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
}