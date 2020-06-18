<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-series-add') ?>">Ajouter</a>
  <h2>Liste des séries</h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Synopsis</th>
        <th scope="col">Image</th>
        <th scope="col">Année de diffusion</th>
        <th scope="col">Catégorie</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list as $series) : ?>
        <tr>
          <th scope="row"><?= $series->getId(); ?></th>
          <td><?= $series->getTitle(); ?></td>
          <td><?php 
            if (strlen($series->getSynopsis()) < 1) {
              echo '';
            } else if (strlen($series->getSynopsis()) < 41) {
              echo $series->getSynopsis();
            } else {
              echo substr($series->getSynopsis(), 0, 40) . '...';
            }
          ?></td>
          <td><?= $series->getPicture(); ?></td>
          <td><?= $series->getReleaseYear(); ?></td>
          <td><?= $series->getCategoryName(); ?></td>
          <td>
            <!-- action buttons -->
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <a class="btn btn-warning mx-2" href="<?= $router->generate('backoffice-series-update', ['id' => $series->getId()]) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <a class="btn btn-danger mx-2" href="<?= $router->generate('backoffice-series-delete', ['id' => $series->getId()]) ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</main>
