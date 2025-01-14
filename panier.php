<div class="container">
  <div class="row">
    <!-- Contenu principal -->
    <div class="col-sm-9">
      <h6> 
        La bibliothèque de Rabelais est fermée au public jusqu'à nouvel ordre. Mais, il vous est possible de 
        réserver et retirer vos livres via notre service Biblio Drive !
      </h6>
      <br><br>
      <?php include 'entete.php';?> 
      <h2 class="text-success text-center my-4">Votre Panier</h2> 
      <?php
      
      require_once('connexion.php'); 


      if (isset($_POST['numero'])) { // vérifie si le numéro est envoyé via un POST  
          $numero = $_POST['numero']; // récupère le numéro du livre envoyé via un POST
          $stmt = $connexion->prepare("SELECT prenom, nom, l.titre, l.anneeparution, l.isbn13, l.detail, l.photo, l.nolivre FROM auteur a INNER JOIN livre l ON a.noauteur = l.noauteur WHERE nolivre = :numero");
          $stmt->bindValue(":numero", $numero); // lie le numéro du livre à la requête SQL
          $stmt->setFetchMode(PDO::FETCH_OBJ);
          $stmt->execute();

          if ($enregistrement = $stmt->fetch()) {  // si un enregistrement est trouvé 
            echo '<div class="text-center" style="display: flex; justify-content: center; align-items: center;">'; 
            echo '<div>';
            echo $enregistrement->prenom . ' ' . $enregistrement->nom . ' - ' . $enregistrement->titre . ' (' . $enregistrement->anneeparution . ')';
            echo '</div>';
            echo '<form method="post" action="vider_panier.php" style="margin-left: 10px;">'; // formulaire pour vider le panier
            echo '<button type="submit">Annuler</button>'; 
            echo '</form>';
            echo '</div>';
        }
        }
      ?>
      <form method="post" action="valider_panier.php" class="text-center my-4">
        <button type="submit" class="btn btn-success">Valider Panier</button>  
      </form>
    </div>
    <div class="col-sm-3">
      <img src="biblio.jpg" width="300px" height="350px" alt="biblio">
      <br><br>
      <?php include 'authentification.php';?>
    </div>
  </div>
</div>
</body>
</html>