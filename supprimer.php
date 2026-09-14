<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: index.php');
  exit;
}
 
$id = $_GET['id'];

// Inclure le bloc de connexion
// ===================== ALERT =====================
//      Choix de conception à interroger non fait ! Cause : bloc catch du fichier connexion.php
// =================================================
require_once 'connexion.php';

// SUPPRESSION sécurisée
  
$sql = "DELETE FROM coachs WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

 
header('Location: index.php');
exit;

