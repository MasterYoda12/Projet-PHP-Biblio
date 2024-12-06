

<?php
$auteur = $_GET["terme"];
    require_once('connexion.php');
        $stmt = $connexion->prepare("SELECT titre, anneeparution FROM livre l INNER JOIN auteur a on (a.noauteur = l.noauteur) where nom like :auteur");
        $stmt->bindValue(":auteur", $auteur);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        while($enregistrement = $stmt->fetch())

        {
          echo '<h1>', $enregistrement->titre, ' ', $enregistrement->anneeparution,'</h1>';
        }
          
?>


 



