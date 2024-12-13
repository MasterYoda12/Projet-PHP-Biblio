
<!DOCTYPE html>
<html>
<body>
<?php
if (!isset($_POST['connexion'])) { 

    echo '   
<h2> Se connecter </h2>
        <form action="authentification.php" method="post">
            Identifiant: <input type="text" name="mel" />
           <br>
            Mot de passe: <input type="password" name="motdepasse" />
            <br>
            <input type="submit" name="connexion" value="Connexion" />
        </form>';

} else    

{
        require_once 'connexion.php';
        $mel = $_POST['mel'];
        $motdepasse = $_POST['motdepasse'];
        $stmt = $connexion->prepare("SELECT * FROM utilisateur where mel=:mel AND motdepasse=:motdepasse");
        $stmt->bindValue(":mel", $mel);
        $stmt->bindValue(":motdepasse", $motdepasse); 
        $stmt->setFetchMode(PDO::FETCH_OBJ);    
        $stmt->execute();
        $enregistrement = $stmt->fetch(); 
        if ($enregistrement) {
            echo '<h1>Connexion réussie !</h1>';
        } else {
            echo "Echec à la connexion.";
        }
    }
    ?>
    </body>
    </html>