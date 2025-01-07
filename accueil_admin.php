<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Titre de la page - Admin</title>
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
      <nav class="navbar navbar-dark bg-primary p-3">
        <div class="input-group w-100">
          <a class="btn btn-success ml-2" href="ajouter_livre.php">Ajouter un livre</a>
          <a class="btn btn-info ml-2" href="creer_membre.php">Créer un membre</a>
        </div>
      </nav>
  </div>
  <div class="col-sm-3">
    <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
    <br><br>
    <?php include 'authentification.php';?>
  </div>
</div>
</body>
</html>