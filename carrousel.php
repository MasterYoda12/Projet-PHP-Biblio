
<?php
require_once('connexion.php');
$stmt = $connexion->prepare("SELECT photo FROM livre order by dateajout DESC limit 3");
$stmt->setFetchMode(PDO::FETCH_OBJ);
$stmt->execute();
?>

<?php 

echo '<div id="demo" class="carousel slide" data-bs-ride="carousel">

  
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
  
  
  <div class="carousel-inner">';
  $x = 0; // Variable pour savoir si c'est le premier élément ou non
    while ($enregistement = $stmt->fetch() ) { // Parcours les résultats
    if ( $x == 0 ) { // Si c'est le premier élément
            echo '<div class="carousel-item active"> 
            <img src="covers/'.$enregistement->photo.'" alt="Test1" class="d-block mx-auto" style="width:25%">
            </div>';
            $x += 1; // On incrémente la variable
        } else {
            echo '<div class="carousel-item">
            <img src="covers/'.$enregistement->photo.'" alt="Test" class="d-block mx-auto" style="width:25%">
          </div>';
        }
    }
?>
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>






  


