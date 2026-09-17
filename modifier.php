<?php

// vérifier la présence de l'id

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo '<div class="alert alert-danger">
          Identifiant manquant.</div>';
  exit;
  }
  
$id = $_GET['id'];

// Inclure le bloc de connexion
require_once 'Connexion.php';
require_once 'Coach.php';

$connexion = new Connexion();
$pdo = $connexion->pdo;


$data = $pdo->prepare("SELECT * FROM coachs");
  
$coachs = $data->fetchAll(PDO::FETCH_ASSOC);

      
      // distinguer affichage et enregistrement 

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['prenom'], $_POST['nom'],
            $_POST['date_prise_fonction'], $_POST['domaine'])) {
    $coachModifie = new Coach(
        $_POST['prenom'], $_POST['nom'], $_POST['date_prise_fonction'], $_POST['domaine']
    );
 
    $stmt = $pdo->prepare("UPDATE coachs
    SET prenom=:prenom, nom=:nom, date_prise_fonction=:datepf, domaine=:domaine
    WHERE id=:id");
    $stmt->bindValue(':prenom', $coachModifie->getPrenom());
    $stmt->bindValue(':nom', $coachModifie->getNom());
    $stmt->bindValue(':datepf', $coachModifie->getStartDate());
    $stmt->bindValue(':domaine', $coachModifie->getDomain());
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    $stmt->execute();



    // message de retour et erreurs
    try{
        echo "<div class='alert alert-success'>
                Informations modifiées avec succès!
            </div>";
        
    }
    catch (PDOException $e) {
    echo "<div class='alert alert-danger'>
            Erreur: " . $e->getMessage() . "
            </div>";
    }

    }
}

// recharger les données à jour

$stmt = $pdo->prepare("SELECT * FROM coachs WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->execute();


$ligne = $stmt->fetch(PDO::FETCH_ASSOC);
$coach = new Coach(
    $ligne['prenom'], $ligne['nom'], $ligne['date_prise_fonction'], $ligne['domaine']
);


//  gérer le coach introuvable  

if (!$coach) {
    echo '<div class="alert alert-danger">
    Etudiant introuvable.</div>';
    exit;
    }
?>    

<form action="" method="POST">
    <p>Vous pouvez modifier les informations du Coach :</p>
    <input type="text" name="prenom"
        value="<?php echo htmlspecialchars($coach->getPrenom());  ?>" >
        
    <input type="text" name="nom"
        value="<?php echo htmlspecialchars($coach->getNom());  ?>" >

    <input type="date" name="date_prise_fonction"
        value="<?php echo htmlspecialchars($coach->getStartDate());  ?>" >
    <input type="text" name="domaine"
        value="<?php echo htmlspecialchars($coach->getDomain());  ?>" >

    <button type="submit">Enregistrer</button>
</form>