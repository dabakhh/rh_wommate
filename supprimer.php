<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}
 
$id = $_GET['id'];

// CONNEXION PDO à REFACTORISER 

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

  // SUPPRESSION sécurisée
  
  $sql = "DELETE FROM coachs WHERE id = :id";
  $stmt = $connexion->prepare($sql);
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();


  } catch (PDOException $e) {
        // erreur silencieuse : le script continue quand même
    }
 
header('Location: index.php');
exit;

