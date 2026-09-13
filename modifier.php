<?php

// vérifier la présence de l'id

if (!isset($_GET['id']) || empty($_GET['id'])) {
  echo '<div class="alert alert-danger">
          Identifiant manquant.</div>';
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

  $data = $connexion->query("SELECT * FROM coachs");
  
  $coachs = $data->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
      echo "Erreur de connexion : " . $e->getMessage();
      }
      
      // distinguer affichage et enregistrement 

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['prenom'], $_POST['nom'],
            $_POST['date_prise_fonction'], $_POST['domaine'])) {
    $prenom  = $_POST['prenom'];
    $nom     = $_POST['nom'];
    $datepf = $_POST['date_prise_fonction'];
    $domaine     = $_POST['domaine'];
    
    // la requête UPDATE
    
    $sqlUpdate = "UPDATE coachs
                  SET prenom=:prenom, nom=:nom,
                      date_prise_fonction=:datepf, domaine=:domaine
                  WHERE id=:id";
 
    $stmtUpdate = $connexion->prepare($sqlUpdate);
    $stmtUpdate->bindParam(':prenom', $prenom);
    $stmtUpdate->bindParam(':nom', $nom);
    $stmtUpdate->bindParam(':datepf', $datepf);
    $stmtUpdate->bindParam(':domaine', $domaine);
    $stmtUpdate->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtUpdate->execute();


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

$sql = "SELECT * FROM coachs WHERE id = :id";
$stmt = $connexion->prepare($sql);
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$coach = $stmt->fetch(PDO::FETCH_ASSOC);

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
        value="<?php echo htmlspecialchars($coach['prenom']); ?>" >
        
    <input type="text" name="nom"
        value="<?php echo htmlspecialchars($coach['nom']); ?>" >

    <input type="date" name="date_prise_fonction"
        value="<?php echo htmlspecialchars($coach['date_prise_fonction']); ?>" >
    <input type="text" name="domaine"
        value="<?php echo htmlspecialchars($coach['domaine']); ?>" >

    <button type="submit">Enregistrer</button>
</form>