
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
                <nav class="navbar navbar-dark bg-primary p-3">
                    <div class="input-group">
                        <form action="lister_livre.php" method="get" class="d-flex w-100">
                            <input type="text" class="form-control" name="terme" placeholder="Rechercher un livre">
                            <button class="btn btn-secondary mx-2" type="submit">Envoyer</button>
                        </form>
                    </div>
                </nav>
                <?php
                include 'carrousel.php';
                echo "<body style='background-color:green'>";
                ?>
            </div>
      
      </div>
      <div class="col-sm-3">
        <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
        <br><br>
        <?php include 'authentification.php';?>
    </div>
  </div>
  
</body>
</html> 

