<?php
if (session_status() == PHP_SESSION_NONE) { // vérifie si la session n'est pas démarrée (Utilisation d'internet car problème de session_start())
  session_start();
}
    if ($_SESSION['profil'] != 'admin') { // vérifie si le profil de l'utilisateur n'est pas admin
        header("Location: accueil.php");
    }

?>

<?php
require_once('connexion.php'); 
//if ($enregistrement->profil !== 'admin') {
  //  echo "Erreur"} else {}

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Si le formulaire a été soumis
    $noauteur = $_POST['noauteur']; // Récupère la valeur du champ de recherche
    $titre = $_POST['titre']; 
    $isbn13 = $_POST['isbn13'];
    $anneeparution = $_POST['anneeparution'];
    $detail = $_POST['detail'];
    $photo = $_POST['photo'];
    $dateajout = date('Y-m-d');

    $stmt = $connexion->prepare("INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo, dateajout) VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :photo, :dateajout)");
    $stmt->bindValue(':noauteur', $noauteur); // Lie le paramètre :noauteur à la valeur de $noauteur 
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':isbn13', $isbn13);
    $stmt->bindValue(':anneeparution', $anneeparution);
    $stmt->bindValue(':detail', $detail);
    $stmt->bindValue(':photo', $photo);
    $stmt->bindValue(':dateajout', $dateajout);
    
    if ($stmt->execute()) { // Exécute la requête
        echo '<div class="alert alert-success" role="alert">Livre ajouté avec succès!</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'ajout du livre!.</div>';
    }
}

$stmt = $connexion->prepare("SELECT noauteur, nom, prenom FROM auteur"); // Prépare la requête
$stmt->setFetchMode(PDO::FETCH_OBJ); // On dit qu'on veut que le résultat soit un objet
$stmt->execute();
$auteurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Ajouter un livre - Admin</title>
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
                <a class="btn btn-info ml-2" href="ajouter_utilisateur.php">Créer un membre</a>
            </div>
        </nav>
        <br><br><br><br><br><br><br><br> 
        <h2>Ajouter un livre</h2>
        <form action="ajouter_livre.php" method="post">
            <div class="mb-3">
            <select name="noauteur" class="form-control" id="noauteur">
                
                <?php
                require_once 'connexion.php';
                $stmt = $connexion->prepare("SELECT noauteur, nom, prenom FROM auteur");
                $stmt->execute();
                while ($auteur = $stmt->fetch(PDO::FETCH_OBJ)) { // Récupère chaque résultat un par un
                    echo "<option value='{$auteur->noauteur}'>{$auteur->prenom} {$auteur->nom}</option>"; 
                     // Affiche chaque auteur sous forme d'options dans la liste déroulante 
                }
                ?>
                
            </select>
            </div>
            <div class="mb-3">
                <input type="text" name="titre" class="form-control" id="titre" placeholder="Titre">
                
            </div>
            <div class="mb-3">
                <input type="text" name="isbn13" class="form-control" id="isbn13" placeholder="ISBN13">
            </div>
            <div class="mb-3">
                <input type="text" name="anneeparution" class="form-control" id="anneeparution" placeholder="Année de parution">
            </div>
            <div class="mb-3">
                <textarea name="detail" class="form-control" id="detail" rows="3" placeholder="Résumé"></textarea>
            </div>
            <div class="mb-3">
                <input type="text" name="photo" class="form-control" id="photo" placeholder="Image">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        
    </div>
    <div class="col-sm-3">
        <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
        <br><br>
        <?php include 'authentification.php';?>
    </div>
    
</div>
<form method="post" action="ajouter_auteur.php" class="text-center my-4"> 
        <button type="submit" class="btn btn-success">Ajouter Auteur</button> 
</form>
  </div>
</div>
</body>
</html>

