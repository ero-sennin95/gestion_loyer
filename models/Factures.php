<?php
namespace App\Model;

use App\Model\Ligne;


class Factures{

    private $id_facture;
    private $date_debut;
    private $date_fin;
    private $date_emission;
    private $montant;
    private $moisannee;
    private $ligne;
    private  $lmanFact;
    //foreign_key
    private $id_contrat_loc;
    private $nom;
    private$prenom;
    private $prov_charges;
    private $loyer_mensuel ;
    
    private $total_debit;

    

    public function __construct() {
        $this->id_facture = -1;
        $this->date_debut = "";
        $this->date_fin = "";	
        $this->date_emission= "";	
        $this->montant="";	
        $this->moisannee="";
        $this->nom="";
        $this->prenom="";
        $this->prov_charges=-1;
        $this->loyer_mensuel =-1;
        $this->total_debit = 0;
        
       $this->ligne = array();
       //$this->ligne = $lmanFact->get 
       // for($i=1;$i<=10;$i++){
        //     $line = new Ligne();
        //     $line->setMontant($i);
        //     array_push($this->ligne,$line);
            // $this->ligne->set
            // $this->ligne = new Ligne();
            // $this->ligne->setId_facture($i);
        // }
       

        //$this->ligne = new Ligne();
       
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
     * Get the value of montant
     */ 
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set the value of montant
     *
     * @return  self
     */ 
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get the value of moisannee
     */ 
    public function getMoisannee()
    {
        return $this->moisannee;
    }

    /**
     * Set the value of moisannee
     *
     * @return  self
     */ 
    public function setMoisannee($moisannee)
    {
        $this->moisannee = $moisannee;

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
     * Get the value of nom
     */ 
    public function getFullName()
    {
        return $this->nom . ' ' . $this->prenom;
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
     * Get the value of date_fin
     */ 
    public function getDate_fin()
    {
        return $this->date_fin;
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

    /**
     * Get the value of date_debut
     */ 
    public function getDate_debut()
    {
        return $this->date_debut;
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
     * Get the value of debit_total
     */ 
    public function getTotal_Debit()
    {
        return $this->total_debit;
    }

    /**
     * Set the value of debit_total
     *
     * @return  self
     */ 
    public function setTotal_Debit($debit_total)
    {
        $this->total_debit = $debit_total;

        return $this;
    }

    /**
     * Get the value of ligne
     */ 
    public function getAllLigne()
    {
        return $this->ligne;
    }

    /**
     * Set the value of ligne
     *
     * @return  self
     */ 
    public function setLigne($lignes)
    {
        foreach($lignes as $ligne){
            $this->ligne[] = $ligne;
        }
        return $this;
    }

    
}