<?php
session_start(); // Démarrer la session

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion ou afficher un message de déconnexion
echo "Vous êtes déconnecté. <a href='login.php'>Se connecter à nouveau</a>";
?>