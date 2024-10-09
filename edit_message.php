<?php
session_start();
require 'db.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour modifier un message. <a href='login.php'>Se connecter</a>";
    exit;
}

// Vérifier si un message_id est passé dans l'URL
if (!isset($_GET['message_id'])) {
    echo "Aucun message spécifié pour modification.";
    exit;
}

$message_id = $_GET['message_id'];

// Requête pour récupérer le message à modifier
$stmt = $pdo->prepare('SELECT * FROM messages WHERE id = ? AND user_id = ?');
$stmt->execute([$message_id, $_SESSION['user_id']]);
$message = $stmt->fetch();

if ($message) {
    // Si le message est trouvé, afficher le formulaire de modification
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $new_message = $_POST['message'];

        if (!empty($new_message)) {
            // Mise à jour du message
            $update_stmt = $pdo->prepare('UPDATE messages SET message = ? WHERE id = ? AND user_id = ?');
            $update_stmt->execute([$new_message, $message_id, $_SESSION['user_id']]);
            echo "Message mis à jour avec succès !";
        } else {
            echo "Le message ne peut pas être vide.";
        }
    } else {
        // Formulaire de modification pré-rempli avec le message actuel
        ?>
        <form method="post" action="edit_message.php?message_id=<?= $message_id ?>">
            <textarea name="message"><?= htmlspecialchars($message['message']) ?></textarea><br>
            <button type="submit">Mettre à jour</button>
        </form>
        <?php
    }
} else {
    echo "Message introuvable ou vous n'avez pas l'autorisation de le modifier.";
}
?>