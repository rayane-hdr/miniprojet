<?php
session_start(); // Démarrer la session
require 'db.php'; // Inclusion de la connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour soumettre un message. <a href='login.php'>Se connecter</a>";
    exit; // Terminer le script si l'utilisateur n'est pas connecté
}

// Si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et valider les données du formulaire
    $message = trim($_POST['message']); // Enlever les espaces inutiles

    if (!empty($message)) {
        // Préparer la requête pour insérer le message dans la base de données
        $stmt = $pdo->prepare('INSERT INTO messages (user_id, message) VALUES (?, ?)');

        try {
            // Exécuter la requête avec l'identifiant de l'utilisateur et le message
            $stmt->execute([$_SESSION['user_id'], $message]);

            echo "Message soumis avec succès ! <a href='view_messages.php'>Voir les messages</a>";
        } catch (PDOException $e) {
            // En cas d'erreur, afficher le message d'erreur
            echo "Erreur lors de l'insertion du message : " . $e->getMessage();
        }
    } else {
        // Si le message est vide
        echo "Le champ du message ne peut pas être vide.";
    }
}
?>

<!-- Formulaire de soumission de message -->
<form method="post" action="submit_message.php">
    <label for="message">Votre message :</label><br>
    <textarea name="message" id="message" rows="5" cols="40" required></textarea><br>
    <button type="submit">Soumettre</button>
</form>