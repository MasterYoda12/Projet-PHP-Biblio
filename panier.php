<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $numero = $_POST['numero'];
    // Add the book to the cart (this is just a placeholder, implement your cart logic here)
    echo "Livre ajouté au panier avec succès!";
} else {
    echo "Vous devez être connecté pour ajouter un livre au panier.";
}
?>