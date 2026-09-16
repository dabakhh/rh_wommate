<?php

// Inclure le bloc de connexion
require_once 'Connexion.php';
require_once 'Coach.php';
 
$connexion = new Connexion();
$pdo = $connexion->pdo;

$data = $pdo->query("SELECT * FROM coachs");
$rows = $data->fetchAll(PDO::FETCH_ASSOC);

$coachs = [];
foreach ($rows as $row) {
    $coachs[] = new Coach(
        $row['prenom'], $row['nom'], $row['date_prise_fonction'], $row['domaine'], $row['id'], $row['adresse']
    );
}

?>

<?php
// =========  AFFICHER LE TABLEAU  =========== 
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<div class="d-flex justify-content-between align-items-center m-4">
    <h2>📖 Liste des coachs</h2>
    <a href="ajouter.php" class="btn btn-success">
        <i class="fa-solid fa-plus"></i> Ajouter un coach
    </a>
</div>

<div class="table-responsive">
    <!-- table-responsive = sur mobile le tableau aura un scroll horizontal -->

    <table class="table table-striped table-hover align-middle">
            <!-- table-striped = lignes alternées gris/blanc pour la lisibilité -->
            <!-- table-hover = la ligne se colore quand tu passes la souris dessus -->
            <!-- align-middle = contenu centré verticalement dans les cellules -->
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Prénoms</th>
                    <th>Nom</th>
                    <th>Date de prise de fonction</th>
                    <th>Domaine</th>
                    <th>Actions</th>
               </tr>        
            </thead>
            
            
            </tbody>
            
                <?php foreach ($coachs as $coach): ?>
                <tr>
                    <td><?php echo $coach->getId(); ?></td>
                    <td><?php echo $coach->getPrenom(); ?></td>
                    <td><?php echo $coach->getNom(); ?></td>
                    <td><?php echo $coach->getStartDate(); ?></td>
                    <td><?php echo $coach->getDomain(); ?></td>
                    <td>
                    <a href="modifier.php?id=<?php echo $coach->getId(); ?>">Modifier</a>
                    <a href="supprimer.php?id=<?php echo $coach->getId(); ?>">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
    </table>

</div>











