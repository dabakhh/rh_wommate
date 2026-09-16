<?php

class Coach {
    private ?int $id;
    private $prenom;
    private $nom;
    private $datepf;
    private $domaine;
    // private $adresse;
 
    // ... constructeur ...
    public function __construct(string $prenom, string $nom, string $datepf, string $domaine, ?int $id = null,) {
      $this->id      = $id;
      $this->prenom  = $prenom;
      $this->nom     = $nom;
      $this->datepf  = $datepf;
      $this->domaine = $domaine;
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
}
