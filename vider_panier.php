<?php
    session_start();


if (isset($_POST['numero'])) {  
    $numero = $_POST['numero'];  
    if (isset($_SESSION['panier'][$numero])) { 
        unset($_SESSION['panier'][$numero]);
    }
}

header('Location: panier.php');

?>