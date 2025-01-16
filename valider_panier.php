<?php

session_start();

require_once('connexion.php');

if (isset($_SESSION['panier'])) { // vérifie si le panier est défini dans la session
    if (isset($_SESSION["mel"])) { // vérifie si l'identifiant est défini dans la session
        foreach ($_SESSION['panier'] as $key=>$value) { // boucle à travers les livres dans le panier pour les ajouter à la table emprunter
            $stmt = $connexion->prepare("INSERT INTO emprunter (mel, nolivre, dateemprunt) VALUES (:mel, :nolivre, :dateemprunt)");
            $mel = $_SESSION["mel"];
            $nolivre = $key; // récupère le numéro du livre dans le panier et l'assigne à la variable nolivre
            $dateemprunt = date("Y-m-d"); 
            $stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
            $stmt->bindValue(':nolivre', $nolivre, PDO::PARAM_INT); // lie le numéro du livre à la requête SQL
            $stmt->bindValue(':dateemprunt', $dateemprunt, PDO::PARAM_STR);
            $stmt->execute();
        }
        // Vider le panier après validation
        unset($_SESSION['panier']);
    } else {
        // Handle the case where mel is not set
        echo "Erreur: Identifiant non défini.";
    }
}
header("Location: panier.php");
?>