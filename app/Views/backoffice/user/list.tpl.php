<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('frontoffice-user-signup') ?>">Ajouter</a>
  <h2>Liste des utilisateurs</h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">E-mail</th>
        <th scope="col">Prénom</th>
        <th scope="col">Nom</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list as $elem) : ?>
        <tr>
          <th scope="row"><?= $elem->getId(); ?></th>
          <td><?= $elem->getEmail(); ?></td>
          <td><?= $elem->getFirstname(); ?></td>
          <td><?= $elem->getLastname(); ?></td>
          <td>
            <!-- action buttons -->
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
              <a class="btn btn-warning mx-2" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
              <a class="btn btn-danger mx-2" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
            </div>
          </td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</main>