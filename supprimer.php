<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}
 
$id = $_GET['id'];

require_once 'Connexion.php';

$connexion = new Connexion();
$pdo = $connexion->pdo;

// SUPPRESSION sécurisée
  
$stmt = $pdo->prepare("DELETE FROM coachs WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

 
header('Location: index.php');
exit;

