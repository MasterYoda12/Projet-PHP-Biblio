<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Titre de la page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="styles.css"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
  <div class="row">
    <!-- Contenu principal -->
    <div class="col-sm-9">
      <h6> 
        La bibliothèque de Rabelais est fermée au public jusqu'à nouvel ordre. Mais, il vous est possible de 
        réserver et retirer vos livres via notre service Biblio Drive !
      </h6>
      <br><br>
      <?php include 'entete.php';?> 
      <h2 class="text-success text-center my-4">Votre Panier</h2>
      <?php
      require_once('connexion.php');

      if (isset($_POST['numero'])) {
          $numero = $_POST['numero'];

          $stmt = $connexion->prepare("SELECT prenom, nom, l.titre, l.anneeparution, l.isbn13, l.detail, l.photo FROM auteur a INNER JOIN livre l ON a.noauteur = l.noauteur WHERE nolivre = :numero");
          $stmt->bindValue(":numero", $numero);
          $stmt->setFetchMode(PDO::FETCH_OBJ);
          $stmt->execute();

          if ($enregistrement = $stmt->fetch()) {
              echo '<div class="text-center">';
              echo $enregistrement->prenom . ' ' . $enregistrement->nom . ' - ';
              echo $enregistrement->titre . ' (' . $enregistrement->anneeparution . ')<br>';
              echo '</div>';
          } else {
              echo 'Livre non trouvé.';
          }
      } else {
          echo 'Numéro de livre non spécifié.';
      }
      ?>
    </div>
    <div class="col-sm-3">
      <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
      <br><br>
      <?php include 'authentification.php';?>
    </div>
  </div>
</div>
</body>
</html>