<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-category-list') ?>">Retour</a>
  <h2>Ajout d'une catégorie</h2>
  <form action="#" method="POST">
    <div class="form-group">
      <label for="name">Nom</label>
      <input type="text" class="form-control" id="name" aria-describedby="category-name" name="name">
      <small id="category-name" class="form-text text-muted">64 caractères maximum</small>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" class="form-control" id="description" aria-describedby="category-description" name="description">
      <small id="category-description" class="form-text text-muted">64 caractères maximum - Permettra de mettre une petite info sur la catégorie</small>
    </div>
    <div class="form-group">
      <label for="picture">Image</label>
      <input type="text" class="form-control" id="picture" aria-describedby="category-picture" name="picture">
      <small id="category-picture" class="form-text text-muted">128 caractères maximum - Il s'agit ici du chemin vers l'image</small>
    </div>
    <!-- Home order selection will have its own page -->
    <div class="form-group">
      <label for="status">Statut</label>
      <select class="custom-select custom-select-lg mb-3" name="status">
        <option value="0" selected>A sélectionner</option>
        <option value="1">Actif</option>
        <option value="2">Inactif</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </form>
</main>