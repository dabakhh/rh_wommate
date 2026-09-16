<form action="" method="POST">
  <input type="text" name="prenom" placeholder="Prénom" required>
  <input type="text" name="nom" placeholder="Nom" required>
  <input type="date" name="date_prise_fonction" required>
  <input type="text" name="domaine" placeholder="Domaine" required>
  <button type="submit">Ajouter</button>
</form> 

<?php

// vérifier que le formulaire a été soumis 
if (isset($_POST['prenom']) && isset($_POST['nom'])
    && isset($_POST['date_prise_fonction']) && isset($_POST['domaine'])) {

    // Inclure le bloc de connexion
    require_once 'Connexion.php';
    require_once 'Coach.php';

    $coach = new Coach(
        $_POST['prenom'], $_POST['nom'],
        $_POST['date_prise_fonction'], $_POST['domaine']
    );      

    $connexion = new Connexion();
    $pdo = $connexion->pdo;
            
    // INSERTION sécurisée
    $sql = "INSERT INTO coachs (prenom, nom, date_prise_fonction, domaine)
    VALUES (:prenom, :nom, :datepf, :domaine)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':prenom', $coach->getPrenom());
    $stmt->bindValue(':nom', $coach->getNom());
    $stmt->bindValue(':datepf', $coach->getStartDate());
    $stmt->bindValue(':domaine', $coach->getDomain());
    $stmt->execute();


    // message de retour et erreurs
    try{
        echo "<div class='alert alert-success'>
                Coach ajouté avec succès!
            </div>";
        
    }
    catch (PDOException $e) {
    echo "<div class='alert alert-danger'>
            Erreur: " . $e->getMessage() . "
            </div>";
    }

}

