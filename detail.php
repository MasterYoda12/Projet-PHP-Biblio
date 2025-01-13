<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Detail</title>
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
          if (isset($_GET["numero"])) { // Si le numéro de livre est spécifié dans l'URL 
            $numero = $_GET["numero"]; // On récupère le numéro de livre  
            require_once('connexion.php'); 
            $stmt = $connexion->prepare("SELECT prenom, nom, l.titre, l.anneeparution, l.isbn13, l.detail, l.photo FROM auteur a INNER JOIN livre l ON a.noauteur = l.noauteur WHERE nolivre = :numero");
            $stmt->bindValue(":numero", $numero); 
            $stmt->setFetchMode(PDO::FETCH_OBJ); // Indique qu'on veut que les résultats soient des objets 
            $stmt->execute();
            while($enregistrement = $stmt->fetch()) { // Parcours les résultats de la requête 
              echo 'Auteur : ' . $enregistrement->prenom . ' ' . $enregistrement->nom . '<br>'; // Affiche le nom de l'auteur 
              echo 'Titre : ' . $enregistrement->titre . '<br>'; // Affiche le titre du livre 
              echo 'Année de parution : ' . $enregistrement->anneeparution . '<br>'; // Affiche l'année de parution du livre 
              echo 'ISBN13 : ' . $enregistrement->isbn13 . '<br>'; // Affiche l'ISBN13 du livre 
              echo 'Résumé du livre <br><br>'; 
              echo $enregistrement->detail . '<br>';  
              echo '<img src="covers/' . $enregistrement->photo . '" alt="Couverture du livre" class="d-block mx-auto" style="width:25%">'; // Affiche la couverture du livre 
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
  <?php
if (isset($_SESSION['loggedin']) && $_SESSION['profil'] == 'client') { // Si l'utilisateur est connecté et est un client 
    echo '<div style="position: fixed; bottom: 10px; left: 10px;"> 
            <form action="panier.php" method="post"> 
                <input type="hidden" name="numero" value="' . $numero . '"> 
                <button type="submit" class="btn btn-success">Emprunter</button>
            </form>
          </div>';
}
?>
</body>
</html>