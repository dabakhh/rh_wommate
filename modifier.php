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
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<p class="m-3">Vous pouvez modifier les informations du Coach :</p>
<form action="" method="POST" class="d-flex gap-3 align-items-center ps-3">
    <div>
        <input type="text" name="prenom"
            value="<?php echo htmlspecialchars($coach->getPrenom());  ?>" >
            
        <input type="text" name="nom"
            value="<?php echo htmlspecialchars($coach->getNom());  ?>" >
    
        <input type="date" name="date_prise_fonction"
            value="<?php echo htmlspecialchars($coach->getStartDate());  ?>" >

        <input type="text" name="domaine"
            value="<?php echo htmlspecialchars($coach->getDomain());  ?>" >
    </div>

    <div class="d-flex gap-3 align-items-center">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-download"></i>Enregistrer</button>
        <a href="index.php" class="btn btn-outline-dark">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </a>
    </div>
</form>