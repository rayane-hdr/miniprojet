<?php
// db.php

$host = 'localhost'; // Adresse de ton serveur MySQL (localhost pour serveur local)
$dbname = 'guestbook'; // Nom de la base de données
$username = 'root'; // Nom d'utilisateur (root par défaut pour serveur local)
$password = ''; // Mot de passe (laisser vide par défaut pour root sur serveur local)

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Configuration de PDO pour générer des exceptions en cas d'erreurs
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Message de confirmation de connexion réussie
    echo "Connexion réussie à la base de données !";
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher le message d'erreur
    die("Erreur : Impossible de se connecter à la base de données. " . $e->getMessage());
}
?>