
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
            <form class="d-flex w-100" action="lister_livre.php" method="get">
              <input type="text" class="form-control me-2" name="terme" placeholder="Rechercher un auteur">
              <button class="btn btn-primary" type="submit">Envoyer</button>
            </form>
          </nav>
          <br>
          <?php
          if (isset($_GET["terme"])) { // Vérifie si un terme de recherche a été entrer
              $auteur = $_GET["terme"]; // Récupère la valeur du champ de recherche
              require_once('connexion.php'); // Charge le fichier de connexion à la base de données
              $stmt = $connexion->prepare("SELECT titre, anneeparution, nolivre FROM livre l INNER JOIN auteur a on (a.noauteur = l.noauteur) where nom like :auteur"); 
              $stmt->bindValue(":auteur", '%' . $auteur . '%'); // Lie le paramètre :auteur à la valeur de $auteur
              $stmt->setFetchMode(PDO::FETCH_OBJ); // Définit le mode de récupération des résultats
              $stmt->execute(); // Exécute la requête
              while($enregistrement = $stmt->fetch()) { // Parcours les résultats
                  // Affiche chaque livre sous forme de lien
                  echo "<h3><a href='http://localhost/biblio/detail.php?numero=".$enregistrement->nolivre."'>", 
                        $enregistrement->titre, " (", $enregistrement->anneeparution, ")</a></h3>";
              }
          } else {
              echo 'Veuillez entrer un terme de recherche.'; 
          }
          ?>
      </div>
      <div class="col-sm-3">
        <img src="biblio.jpg" width="300px" height="350px" alt="biblio"> >
        <br><br> 
        <?php include 'authentification.php';?> 
      </div>
    </div>
  </div>
</body>
</html>