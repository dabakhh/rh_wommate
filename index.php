<?php

// Inclure le bloc de connexion
require_once 'connexion.php';

$data = $connexion->query("SELECT * FROM coachs");
 
$coachs = $data->fetchAll(PDO::FETCH_ASSOC);
?>

<?php// =========  AFFICHER LE TABLEAU  =========== ?>
<table border="1"> 
    <thead>
        <tr>
            <th>#</th>
            <th>Prénoms</th>
            <th>Nom</th>
            <th>Date de prise de fonction</th>
            <th>Domaine</th>
            <th>Adresse</th>
            <th>Actions</th>
       </tr>        
    </thead>


    </tbody>

        <?php foreach ($coachs as $coach): ?>
        <tr>
            <td><?php echo $coach['id']; ?></td>
            <td><?php echo $coach['prenom']; ?></td>
            <td><?php echo $coach['nom']; ?></td>
            <td><?php echo $coach['date_prise_fonction']; ?></td>
            <td><?php echo $coach['domaine']; ?></td>
            <td><?php echo $coach['adresse']; ?></td>
            <!-- ... rattachés ... -->
        
            <td>
            <a href="modifier.php?id=<?php echo $coach['id']; ?>">Modifier</a>
            <a href="supprimer.php?id=<?php echo $coach['id']; ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>


</table>


