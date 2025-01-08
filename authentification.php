<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Titre de la page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    .custom-border {
      border: 2px solid black; 
      background-color: #f0f0f0; 
    }
  </style>
</head>
<body>
<div class="container">
<?php

if (!isset($_POST['connexion'])) { 
    echo '<h2>Se connecter</h2>';
    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post" class="mb-3">
            <div class="mb-3">
              <label for="mel" class="form-label">Identifiant:</label>
              <input type="text" name="mel" class="form-control" id="mel" />
            </div>
            <div class="mb-3">
              <label for="motdepasse" class="form-label">Mot de passe:</label>
              <input type="password" name="motdepasse" class="form-control" id="motdepasse" />
            </div>
            <button type="submit" name="connexion" class="btn btn-primary">Connexion</button>
          </form>';
} else {
    require_once 'connexion.php';
    $mel = $_POST['mel'];
    $motdepasse = $_POST['motdepasse'];
    $stmt = $connexion->prepare("SELECT mel, nom, prenom, adresse, ville, codepostal, profil FROM utilisateur WHERE mel=:mel AND motdepasse=:motdepasse");
    $stmt->bindValue(":mel", $mel);
    $stmt->bindValue(":motdepasse", $motdepasse); 
    $stmt->setFetchMode(PDO::FETCH_OBJ);    
    $stmt->execute();
    $enregistrement = $stmt->fetch(); 
    if ($enregistrement) {
        $_SESSION['loggedin'] = true;
        echo '<div class="custom-border p-4 mt-4">';
        echo '<p>Identifiant: ' . $enregistrement->mel . '</p>';
        echo '<p>Nom: ' . $enregistrement->nom . '</p>';
        echo '<p>Prénom: ' . $enregistrement->prenom . '</p>';
        echo '<p>Adresse: ' . $enregistrement->adresse . '</p>';
        echo '<p>Ville: ' . $enregistrement->ville . '</p>';
        echo '<p>Code Postal: ' . $enregistrement->codepostal . '</p>';
        echo '<p><h3>' . $enregistrement->profil . '<h3></p>';
        echo '</div>';
        echo '<form action="deconnexion.php" method="post">';
        echo '<button type="submit" class="btn btn-danger mt-3">Déconnexion</button>';
        echo '</form>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Echec à la connexion.</div>';
    }
}
?>
</div>
</body>
</html>