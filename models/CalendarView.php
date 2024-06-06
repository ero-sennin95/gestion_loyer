<?php

namespace App\Model;


class CalendarView{
    
    private $dateFacture;
    private $factures;
    
    
    public function __construct() {
       $this->factures = array();
       $this->dateFacture = date("Y-m-d");
   }

   public function addFacture(Factures2 $facture){
     $this->factures = $facture;
   }

   

    /**
     * Get the value of factures
     */ 
    public function getFactures()
    {
        return $this->factures;
    }

    /**
     * Set the value of dateFacture
     *
     * @return  self
     */ 
    public function setDateFacture($dateFacture)
    {
        $this->dateFacture = $dateFacture;

        return $this;
    }
}