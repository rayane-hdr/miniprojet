<?php
require 'db.php'; // Inclusion du fichier de connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérification que les champs ne sont pas vides
    if (!empty($username) && !empty($password) && !empty($confirm_password)) {

        // Vérification que le mot de passe et la confirmation correspondent
        if ($password === $confirm_password) {

            // Hashage du mot de passe pour le stocker de manière sécurisée
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Requête pour insérer un nouvel utilisateur
            $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');

            try {
                $stmt->execute([$username, $hashedPassword]); // Exécution de la requête

                // Message de succès si tout fonctionne bien
                echo "Inscription réussie ! Vous pouvez maintenant vous connecter.";
            } catch (PDOException $e) {
                // Gérer les erreurs de requête, par exemple si le nom d'utilisateur est déjà pris
                echo "Erreur : " . $e->getMessage();
            }

        } else {
            echo "Les mots de passe ne correspondent pas.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}
?>

<!-- Formulaire d'inscription -->
<form method="post" action="register.php">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" id="username" required><br>

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required><br>

    <label for="confirm_password">Confirmez le mot de passe :</label>
    <input type="password" name="confirm_password" id="confirm_password" required><br>

    <button type="submit">S'inscrire</button>
</form>