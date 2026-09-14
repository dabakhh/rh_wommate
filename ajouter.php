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
   
    // récupérer les valeurs postées
    $prenom  = $_POST['prenom'];
    $nom     = $_POST['nom'];
    $datepf = $_POST['date_prise_fonction'];
    $domaine = $_POST['domaine'];

    // Inclure le bloc de connexion
    require_once 'connexion.php';
            
    // INSERTION sécurisée
    $sql = "INSERT INTO coachs (prenom, nom, date_prise_fonction, domaine)
    VALUES (:prenom, :nom, :datepf, :domaine)";
    
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':datepf', $datepf);
    $stmt->bindParam(':domaine', $domaine);
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

