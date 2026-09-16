<?php

class Connexion{
    private $serveur     = "localhost";
    private $base        = "rh_wommate";
    private $utilisateur = "root";
    private $motDePasse  = "";
    public $pdo;

    public function __construct() {
        $this->pdo = new PDO(
            "mysql:host={$this->serveur};dbname={$this->base};charset=utf8",
            $this->utilisateur, $this->motDePasse
        );
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}

