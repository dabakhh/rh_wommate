<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<form action="" method="POST" class="d-flex gap-3 align-items-center ps-3">
    <div>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="date" name="date_prise_fonction" required>
        <input type="text" name="domaine" placeholder="Domaine" required>

    </div>
    <div class="d-flex gap-3 align-items-center m-4">
        <button type="submit" class="btn btn-success"><i class="fa-solid fa-download"></i>Enregistrer</button>
        <a href="index.php" class="btn btn-outline-dark">
            <i class="fa-solid fa-arrow-left"></i> Retour
        </a>
    </div>
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

