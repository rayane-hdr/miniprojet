<?php
require 'db.php';

// Récupérer tous les messages avec le nom d'utilisateur associé
$stmt = $pdo->query('
    SELECT messages.id, messages.message, messages.created_at, users.username 
    FROM messages 
    JOIN users ON messages.user_id = users.id 
    ORDER BY messages.created_at DESC
');

$messages = $stmt->fetchAll();

if ($messages) {
    foreach ($messages as $message) {
        echo "<p><strong>" . htmlspecialchars($message['username']) . "</strong> (" . $message['created_at'] . "):<br>"
            . htmlspecialchars($message['message'])
            . "</p>";

        // Ajouter un lien pour modifier chaque message
        echo "<a href='edit_message.php?message_id=" . $message['id'] . "'>Modifier</a>";
    }
} else {
    echo "Aucun message n'a encore été soumis.";
}
?>