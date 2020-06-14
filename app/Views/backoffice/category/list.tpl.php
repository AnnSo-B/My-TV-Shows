<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-category-add') ?>">Ajouter</a>
  <h2>Liste des catégories</h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list as $elem) : ?>
        <tr>
          <th scope="row"><?= $elem->getId(); ?></th>
          <td><?= $elem->getName(); ?></td>
          <td><?= $elem->getDescription(); ?></td>
          <td><?= $elem->getPicture(); ?></td>
          <td>
            <!-- action buttons -->
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <a class="btn btn-warning mx-2" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-danger mx-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="#">Oui, supprimer.</a>
                </div>
              </div>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</main>