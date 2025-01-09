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
      <div class="col-sm-9">
          <h6>La bibliothèque de Rabelais est fermée au public jusqu'à nouvel ordre. Mais, il vous est possible de réserver et retirer vos livres via notre service Biblio Drive !</h6>
          <br>
          <br>
          <nav class="navbar navbar-dark bg-blue">
            <form class="d-flex w-100" action="lister_livre.php" method="get">
              <input type="text" class="form-control me-2" name="terme" placeholder="Rechercher un auteur">
              <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
          </nav>
          <br>
          <?php
          if (isset($_GET["numero"])) {
              $numero = $_GET["numero"];
              require_once('connexion.php');
              $stmt = $connexion->prepare("SELECT prenom, nom, l.isbn13, l.detail FROM auteur a INNER JOIN livre l ON a.noauteur = l.noauteur WHERE nolivre = :numero");
              $stmt->bindValue(":numero", $numero);
              $stmt->setFetchMode(PDO::FETCH_OBJ);
              $stmt->execute();
              while($enregistrement = $stmt->fetch()) {
                  echo 'Auteur : ' . $enregistrement->prenom . ' ' . $enregistrement->nom . '<br>';
                  echo 'ISBN13 : ' . $enregistrement->isbn13 . '<br>';
                  echo 'Résumé du livre <br><br>';
                  echo $enregistrement->detail . '<br>';
              }
              if (isset($_SESSION['user_id'])) {
                  echo '<button class="btn btn-success">Emprunter</button>';
              }
              $stmt = $connexion->prepare("SELECT photo FROM livre WHERE nolivre = :numero");
              $stmt->bindValue(":numero", $numero);
              $stmt->setFetchMode(PDO::FETCH_OBJ);
              $stmt->execute();
              while($enregistrement = $stmt->fetch()) {
                  echo '<img src="covers/' . $enregistrement->photo . '" alt="Couverture du livre" class="d-block mx-auto" style="width:25%">';
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
  <form action="panier.php" method="post" style="position: fixed; bottom: 10px; left: 10px;">
    <input type="hidden" name="nolivre" value="<?php echo $numero; ?>">
    <button class="btn btn-success" type="submit">Emprunter</button>
</form>
</body>
</html>