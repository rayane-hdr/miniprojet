<?php
session_start(); // Démarrer la session

if (isset($_SESSION['user_id'])) {
    echo "Bienvenue " . htmlspecialchars($_SESSION['username']) . " ! Vous êtes connecté.";
} else {
    echo "Vous devez vous connecter pour accéder à cette page.";
}
?>