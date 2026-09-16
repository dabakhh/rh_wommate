<?php

class Coach {
    private $id;
    private $prenom;
    private $nom;
    private $datepf;
    private $domaine;
    private $adresse;
 
    // ... constructeur ...
    public function __construct($id, $prenom, $nom, $datepf, $domaine, $adresse) {
      $this->id  = $id;
      $this->prenom  = $prenom;
      $this->nom     = $nom;
      $this->datepf  = $datepf;
      $this->domaine = $domaine;
      $this->adresse = $adresse;
    }

    // ... getters
    public function getId() {
        return $this->id;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getStartDate() {
        return $this->datepf;
    }

    public function getDomain() {
        return $this->domaine;
    }

    public function getAddress() {
        return $this->adresse;
    }
}
