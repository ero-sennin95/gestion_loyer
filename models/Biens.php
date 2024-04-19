<?php

namespace App\Model;

class Biens{

    private $id_bien;
    private $nom;
    private $type_Biens;
    private $adresse1;
    private $adresse2;
    private $ville;
    private $cp;
    private $description;

    //Foreign keys
    private $id_contrat_loc;
    private $id_locataire;
     private $nom_loc;
     private $prenom_loc;
     
     
     public function __construct() {
        $this->id_bien = -1;
        $this->nom = "";
        $this->type_Biens = "";	
        $this->adresse1= "";	
        $this->adresse2="";	
        $this->ville="";	
        $this->cp=0;
        $this->description="";	
      
       
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
     * Get the value of type_biens
     */ 
    public function getType_biens()
    {
        return $this->type_Biens;
    }

    /**
     * Set the value of type_biens
     *
     * @return  self
     */ 
    public function setType_biens($type_biens)
    {
        $this->type_Biens = $type_biens;

        return $this;
    }

    /**
     * Get the value of adresse1
     */ 
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set the value of adresse1
     *
     * @return  self
     */ 
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get the value of adresse2
     */ 
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set the value of adresse2
     *
     * @return  self
     */ 
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get the value of ville
     */ 
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set the value of ville
     *
     * @return  self
     */ 
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get the value of cp
     */ 
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set the value of cp
     *
     * @return  self
     */ 
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

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
      * Get the value of nom_loc

      */ 
     public function getFullName()
     {
        if(isset($this->nom_loc
) ||  isset($this->prenom_loc))
            return $this->nom_loc
     . ' ' . $this->prenom_loc;
        else
            return "-";
     }

     public function getNom()
     {
          return $this->nom;
     }

   
    /**
     * Get the value of nom_biens
     */ 
    public function getPrenom()
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
}

