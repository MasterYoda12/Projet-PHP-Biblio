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
          <nav class = "navbar navbar-dark bg-blue">
          <div class= "group-input">
          <form action = "lister_livre.php" method ="get">
            <input type = "text" class="form-control" name = "terme">
          <div class="input-group-btn">
              <button class="btn btn-default" type="submit">Envoyer</button>
         
          </form>  
      </div>
    </nav>
    <?php
$numero = $_GET["numero"];
    require_once('connexion.php');
        $stmt = $connexion->prepare("SELECT prenom, nom,l.isbn13, l.detail from auteur a inner join livre l on (a.noauteur = l.noauteur) where nolivre = :numero");
        $stmt->bindValue(":numero", $numero);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        while($enregistrement = $stmt->fetch())
        {
          echo 'Auteur : ' .$enregistrement->prenom. ' ' .$enregistrement->nom.  '<br> ';
          echo 'ISBN13 : ' .$enregistrement->isbn13. '<br>';
          echo 'Résumé du livre <br> <br>';
          echo ' '.$enregistrement->detail. ' ';
        }
          
?>
 <?php
$numero = $_GET["numero"];
    require_once('connexion.php');
        $stmt = $connexion->prepare("SELECT photo from livre  where nolivre = :numero");
        $stmt->bindValue(":numero", $numero);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        while($enregistrement = $stmt->fetch())
        {
            echo '<img src="covers/'.$enregistrement->photo.'"alt="test" class="d-block mx-auto" style="width:25%">';
          }
        
          
?>
      
      </div>
      
      
      <div class="col-sm-3">
        <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
        <br>
        <br>
        <?php include 'authentification.php';?>
    </div>
 
  
</body>
</html> 