<?php

$serveur     = "localhost";
$base        = "rh_wommate";
$utilisateur = "root";
$motDePasse  = "";

try {
  $connexion = new PDO(
    "mysql:host=$serveur;dbname=$base;charset=utf8" ,
    $utilisateur, $motDePasse
  );
 
  $connexion->setAttribute(
    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
  );

} catch (PDOException $e) {
  echo "Erreur de connexion : " . $e->getMessage();
}