<?php
session_start();
require_once('connexion.php');

// Vérifier l'authentification
if (!isset($_SESSION['user_id'])) {
    header("Location: se_connecter.php");
    exit();
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $noauteur = $_POST['noauteur']; // ID de l'auteur sélectionné
    $isbn13 = $_POST['isbn13'];
    $detail = $_POST['detail'];
    $dateajout = date('Y-m-d H:i:s'); // Date et heure actuelles

    // Insertion dans la base de données
    $stmt = $connexion->prepare(
        "INSERT INTO livre (titre, noauteur, isbn13, detail, dateajout) 
         VALUES (:titre, :noauteur, :isbn13, :detail, :dateajout)"
    );
    $stmt->bindValue(':titre', $titre);
    $stmt->bindValue(':noauteur', $noauteur);
    $stmt->bindValue(':isbn13', $isbn13);
    $stmt->bindValue(':detail', $detail);
    $stmt->bindValue(':dateajout', $dateajout);

    if ($stmt->execute()) {
        $success = "Le livre a été ajouté avec succès.";
    } else {
        $error = "Une erreur est survenue lors de l'ajout du livre.";
    }
}

// Récupération des auteurs pour la liste déroulante
$stmt = $connexion->prepare("SELECT noauteur, prenom, nom FROM auteur ORDER BY nom ASC");
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
$auteurs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un Livre</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter un Livre</h2>
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="ajouter_livre.php">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre du Livre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="noauteur" class="form-label">Auteur</label>
                <select class="form-select" id="noauteur" name="noauteur" required>
                    <option value="" selected disabled>Choisissez un auteur</option>
                    <?php foreach ($auteurs as $auteur): ?>
                        <option value="<?= $auteur->noauteur ?>">
                            <?= $auteur->prenom ?> <?= $auteur->nom ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="isbn13" class="form-label">ISBN13</label>
                <input type="text" class="form-control" id="isbn13" name="isbn13" required>
            </div>
            <div class="mb-3">
                <label for="detail" class="form-label">Résumé</label>
                <textarea class="form-control" id="detail" name="detail" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
