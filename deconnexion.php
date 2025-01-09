<?php
session_start(); // On démarre la session
session_destroy(); // On détruit les données de la session
header('Location: accueil.php'); // On redirige l'utilisateur vers la page d'accueil
exit; 
?>