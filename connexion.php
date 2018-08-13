<?php
session_start();

require_once('mysql.php');
require_once('fonctions.php');

// Si l'utilisateur est déjà connecté
if (verifierConnexion())
    header('Location: chiffre.php');

// Si le formulaire a été envoyé
if (isset($_POST['connexion']) && isset($_POST['utilisateur']) && isset($_POST['mot_de_passe'])) {
    // On teste si les identifiants sont corrects
    $sth = $pdo->query("SELECT id FROM utilisateurs
			WHERE nom_utilisateur = '" . $_POST['utilisateur'] . "'
			AND mot_de_passe = '" . $_POST['mot_de_passe'] . "'");

    $resultat = $sth->fetch(PDO::FETCH_ASSOC);

    if ($resultat !== false) {
        // Connexion réussie
        if ($_POST['se_souvenir'] == "oui") {
            setCookie('utilisateur', $_POST['utilisateur'], 86400 * 30);
            setCookie('mot_de_passe', $_POST['mot_de_passe'], 86400 * 30);
        }

        $_SESSION['utilisateur'] = $_POST['utilisateur'];
        $_SESSION['id_utilisateur'] = $resultat['id'];

        header('Location: chiffre.php');

    } else {
        // Connexion échouée
        $erreur = true;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Chiffre de César</title>
</head>
<body style="padding: 20px">
<div style="display: inline-block">
    <div>
        <a href="./inscription.php">S'enregistrer</a>
    </div>
    <h3>Se connecter</h3>
    <form action="" method="post">
        <?php
        if (isset($erreur))
            echo "Erreur: identifiants incorrects<br><br>";
        ?>
        <label for="utilisateur">Nom d'utilisateur</label><br>
        <input type="text" name="utilisateur" id="utilisateur"><br>
        <br>
        <label for="mot_de_passe">Mot de passe</label><br>
        <input type="password" name="mot_de_passe" id="mot_de_passe"><br>
        <br>
        <input type="checkbox" name="se_souvenir" value="oui" id="se_souvenir">
        <label for="se_souvenir">Se souvenir de moi</label><br>
        <br>
        <input type="submit" name="connexion" value="Se connecter">
    </form>
</div>
</body>
</html>