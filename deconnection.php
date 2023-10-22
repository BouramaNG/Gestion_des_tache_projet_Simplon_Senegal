<?php
// Démarrez la session
session_start();

// Détruisez la session actuelle pour déconnecter l'utilisateur
session_destroy();

// Redirigez l'utilisateur vers la page de connexion
header("Location: inscription.php");
exit();
?>
