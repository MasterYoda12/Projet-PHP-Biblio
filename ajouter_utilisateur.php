<?php
require_once('connexion.php');
$stmt = $connexion->prepare("INSERT INTO utilisateur (nom, prenom, mel, mot_de_passe) VALUES (:nom, :prenom, :mel, :mot_de_passe)");
$nom = 'Dupont';
$prenom = 'Paul';
$mel = 'p.dupont@yahoo.fr';
$mot_de_passe = 'secretdupont';
$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
$stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
$stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
$stmt->bindValue(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);


$stmt->execute();
$nb_ligne_affectees = $stmt->rowCount();
echo $nb_ligne_affectees." ligne() insérée(s).<BR>";
$dernier_numero = $connexion->lastInsertId();
echo "Dernier numéro utilisateur généré : ".$dernier_numero."<BR>";
$nom = 'Tremblay';
$prenom = 'Robert';
$mel = 'r.tremblay@gmail.fr';
$mot_de_passe = 'secrettremblay';
$stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
$stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);
$stmt->bindValue(':mel', $mel, PDO::PARAM_STR);
$stmt->bindValue(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
$stmt->execute();
$nb_ligne_affectees = $stmt->rowCount();
echo $nb_ligne_affectees." ligne() insérée(s).<BR>";
$dernier_numero = $connexion->lastInsertId(); // Optionnel, Nota Bene : sur récup. sur l'objet PDO, connexion
echo "Dernier numéro utilisateur généré : ".$dernier_numero."<BR>";
?>

 