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
  <div class="row">
    <div class="col-sm-6">
      <h2>Ajouter un utilisateur</h2>
      <form action="ajouter_utilisateur.php" method="post">
          <div class="mb-3">
              <label for="mel" class="form-label">Email:</label>
              <input type="email" class="form-control" id="mel" name="mel" required>
          </div>
          <div class="mb-3">
              <label for="motdepasse" class="form-label">Mot de passe:</label>
              <input type="password" class="form-control" id="motdepasse" name="motdepasse" required>
          </div>
          <div class="mb-3">
              <label for="nom" class="form-label">Nom:</label>
              <input type="text" class="form-control" id="nom" name="nom" required>
          </div>
          <div class="mb-3">
              <label for="prenom" class="form-label">Prénom:</label>
              <input type="text" class="form-control" id="prenom" name="prenom" required>
          </div>
          <div class="mb-3">
              <label for="adresse" class="form-label">Adresse:</label>
              <input type="text" class="form-control" id="adresse" name="adresse" required>
          </div>
          <div class="mb-3">
              <label for="ville" class="form-label">Ville:</label>
              <input type="text" class="form-control" id="ville" name="ville" required>
          </div>
          <div class="mb-3">
              <label for="codepostal" class="form-label">Code Postal:</label>
              <input type="text" class="form-control" id="codepostal" name="codepostal" required>
          </div>
          <button type="submit" class="btn btn-primary">Créer un membre</button>
      </form>

      <?php
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          require_once 'connexion.php';

          $mel = $_POST['mel'];
          $motdepasse = $_POST['motdepasse'];
          $nom = $_POST['nom'];
          $prenom = $_POST['prenom'];
          $adresse = $_POST['adresse'];
          $ville = $_POST['ville'];
          $codepostal = $_POST['codepostal'];

          $stmt = $connexion->prepare("INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :ville, :codepostal, 'client')");
          $stmt->bindValue(':mel', $mel);
          $stmt->bindValue(':motdepasse', $motdepasse);
          $stmt->bindValue(':nom', $nom);
          $stmt->bindValue(':prenom', $prenom);
          $stmt->bindValue(':adresse', $adresse);
          $stmt->bindValue(':ville', $ville);
          $stmt->bindValue(':codepostal', $codepostal);

          if ($stmt->execute()) {
              echo '<div class="alert alert-success" role="alert">Utilisateur ajouté avec succès!</div>';
          } else {
              echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'ajout de l\'utilisateur.</div>';
          }
      }
      ?>
    </div>
  </div>
</div>
</body>
</html>