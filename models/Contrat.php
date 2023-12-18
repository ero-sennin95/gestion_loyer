<?php

namespace App\Model;

class Contrat{
    private $id_contrat_loc;
    private $prov_charges;
    private $loyer_mensuel;
    private $caution;
    private $jour_versement;
    private $date_entree;
    private $fin_bail;
    private $notes;
    private $id_locataire;
    private $id_bien;

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
     * Get the value of fin_bail
     */ 
    public function getFin_bail()
    {
        return $this->fin_bail;
    }

    /**
     * Set the value of fin_bail
     *
     * @return  self
     */ 
    public function setFin_bail($fin_bail)
    {
        $this->fin_bail = $fin_bail;

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
}
