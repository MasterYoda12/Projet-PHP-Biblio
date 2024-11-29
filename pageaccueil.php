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
        <h5>La bibliothèque de Rabelais est fermée au public jusqu'à nouvel ordre. Mais, il vous est possible de réserver et retirer vos livres via notre service Biblio Drive !</h5>
        <br>
        <br>
        <form action = "pageaccueil.php" method ="get">
          <input type = "search" name = "terme">
          <input type = "submit" name = "recherche" value = "Rechercher">
        </form>
      </div>
      <div class="col-sm-3">
        <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
        <br>
        <br>
        <h2> Se connecter </h2>
        <form action="connexion.php" method="post">
            Identifiant: <input type="text" name="pseudo" />
            <br />
            Mot de passe: <input type="password" name="mdp" />
            <br />
            <input type="submit" name="connexion" value="Connexion" />
        </form>
      </div>
    </div>
  </div>
</body>
</html> 