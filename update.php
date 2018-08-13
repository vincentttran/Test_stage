<?php
include 'config.php';
include 'lib-pdo.php';

//Récupération de l'identifiant du client passé dans l'URL
$idClient = filter_input(INPUT_GET, 'idClient', FILTER_VALIDATE_INT);


//Initialisation du message d'erreur
$errorMessage = "";

//Instance de PDO
$connexion = getPDO();



if($idClient == null){
    //Récupération des données
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    //Récupération de l'identifiant du client à modifier
    $idClient = filter_input(INPUT_POST, 'idClient', FILTER_VALIDATE_INT);

    $dateNaissance = filter_input(INPUT_POST, 'dateNaissance', FILTER_SANITIZE_STRING);
    $isSubmited = filter_has_var(INPUT_POST,'submit');

} else {
    // Le formulaire n'est pas posté donc
    //Récupération des infos du client

    $sql = "SELECT * FROM users WHERE nom";
    $statement = $connexion->prepare($sql);
    $statement->execute([$idClient]);
    $personne = $statement->fetch(PDO::FETCH_ASSOC);

    $nom = $personne["nom"];
    $prenom = $personne["prenom"];
    $email = $personne["email"];
    $dateNaissance = $personne["date_naissance"];

    $isSubmited = false;
}



//Traitement des données
if ($isSubmited){

    //Validation des données
    $valid =    !empty($nom) && !empty($email) &&
        ! empty($dateNaissance);

    if($prenom==''){
        $prenom = null;
    }

    if($valid){
        try {


            //Requête SQL d'insertion
            $sql = "UPDATE clients SET 
                        nom = UPPER(:nom), 
                        prenom = :prenom, 
                        email = :email, 
                        date_naissance = :dateNaissance
                    WHERE id_client=:idClient";

            //Préparation de la requête
            $statement = $connexion->prepare($sql);

            //exécution de la requête
            $statement->execute([
                'nom'           => $nom,
                'prenom'        => $prenom,
                'email'         => $email,
                'telephone' => $telephone,
                'secteur_activite'      => $secteur_activite
            ]);

            //Redirection en cas de succès
            header("location:index.php");

        } catch (\PDOException $e){
            $errorMessage = $e->getMessage();
        }
    } else {
        $errorMessage = "Votre saisie est invalide";
    }
}

?>

<!DOCTYPE html>

<html>
<head>
    <title>Insertion de client</title>
    <meta charset="utf-8">
</head>
<body>

<div>
    <?=$errorMessage?>
</div>

<form method="post" action="update.php">
    <label>Nom
        <input type="text" name="nom" value="<?=$nom?>">
    </label><br>

    <label>Prénom
        <input type="text" name="prenom" value="<?=$prenom?>">
    </label><br>

    <label>email
        <input type="email" name="email" value="<?=$email?>">
    </label><br>

    <input type="hidden" name="idClient" value="<?=$idClient?>">

    <label>Date de naissance
        <input type="date" name="dateNaissance" value="<?=$dateNaissance?>">
    </label><br>

    <button type="submit" name="submit">Valider</button>
</form>

</body>
</html>