<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=u",
        "chiffre", // Nom d'utilisateur
        "123456" // Mot de passe
    );
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}