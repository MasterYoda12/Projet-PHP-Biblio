
<!DOCTYPE html>
<html lang="fr">
<head>
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
          <div class="group-input">
          <form action="lister_livre.php" method="get">
            <input type="text" class="form-control" name="terme">
          <div class="input-group-btn">
              <button class="btn btn-default" type="submit">Envoyer</button>
          </form>  
      </div>
    </nav>
    <?php
    
    if (isset($_GET["terme"])) {
        $auteur = $_GET["terme"];
        require_once('connexion.php');
        $stmt = $connexion->prepare("SELECT titre, anneeparution, nolivre FROM livre l INNER JOIN auteur a on (a.noauteur = l.noauteur) where nom like :auteur");
        $stmt->bindValue(":auteur", '%' . $auteur . '%');
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        while($enregistrement = $stmt->fetch()) {
            echo "<h3><a href='http://localhost/biblio/detail.php?numero=".$enregistrement->nolivre."'>", $enregistrement->titre, " (", $enregistrement->anneeparution, ")</a></h3>";
        }
    } else {
        echo 'Veuillez entrer un terme de recherche.';
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