<?php


include 'config.php';
include 'lib-pdo.php';

$connexion = getPDO();


try {
    $sql = "SELECT * FROM users";
    $resultSet = $connexion->query($sql);
    $rows = $resultSet->fetchAll(PDO::FETCH_OBJ);
    $resultSet = null;
    $nbRows = count($rows);
} catch (\PDOException $exception){
    echo $exception->getMessage();
    exit;
}


?>

<a href="insert.php">Ajouter un client</a>

<table>

    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>téléphone</th>
        <th>secteur d'activités</th>
        <th>Disponibilité</th>
        <th>Mots de passe</th>
        <th>Status</th>
    </tr>

    <?php foreach ($rows as $client): ?>
        <tr>
            <td><?=$client->nom?></td>
            <td><?=$client->prenom?></td>
            <td><?=$client->email?></td>
            <td><?=$client->telephone?></td>
            <td><?=$client->secteur_activite?></td>
            <td><?=$client->disponibilite?></td>
            <td><?=$client->password?></td>
            <td><?=$client->status?></td>


            <td>
                <a href="delete.php?idClient=<?=$client->id_client?>">
                    Supprimer
                </a> |
                <a href="update.php?idClient=<?=$client->id_client?>">
                    Modifier
                </a>
            </td>
        </tr>
    <?php endforeach; ?>

</table>
