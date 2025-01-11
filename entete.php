<nav class="navbar navbar-dark bg-primary p-3">
  <div class="input-group w-100">
    <form action="lister_livre.php" method="get" class="d-flex w-75">
      <input type="text" class="form-control" name="terme" placeholder="Rechercher un livre">
      <button class="btn btn-secondary mx-2" type="submit">Envoyer</button>
    </form>
    <form action="panier.php" method="get" class="ml-2">
      <button class="btn btn-warning" type="submit">Panier</button>
    </form>
  </div>
</nav>
