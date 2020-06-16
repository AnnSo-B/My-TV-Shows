<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-main-home') ?>">Retour</a>
  <h2>Sélection des catégories affichées sur la page d'accueil</h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <form action="" method="POST">
    <input type="hidden" id="csrfToken" name="csrfToken" value="<?= $csrfToken ?>"/>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="home-order-1">1ère catégorie</label>
          <select class="form-control" id="home-order-1" name="home-order[]">
            <option value="0">A sélectionner</option>
            <?php foreach ($list as $elem) : ?>
              <option
                value="<?= $elem->getId() ?>"
                <?= $elem->getHomeOrder() == 1 ? 'selected' : '' ?>
              >
                <?= $elem->getName() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="home-order-2">2nde catégorie</label>
          <select class="form-control" id="home-order-2" name="home-order[]">
            <option value="0">A sélectionner</option>
            <?php foreach ($list as $elem) : ?>
              <option
                value="<?= $elem->getId() ?>"
                <?= $elem->getHomeOrder() == 2 ? 'selected' : '' ?>
              >
                <?= $elem->getName() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="home-order-3">3ème catégorie</label>
          <select class="form-control" id="home-order-3" name="home-order[]">
            <option value="0">A sélectionner</option>
            <?php foreach ($list as $elem) : ?>
              <option
                value="<?= $elem->getId() ?>"
                <?= $elem->getHomeOrder() == 3 ? 'selected' : '' ?>
              >
                <?= $elem->getName() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="home-order-4">4ème catégorie</label>
          <select class="form-control" id="home-order-4" name="home-order[]">
            <option value="0">A sélectionner</option>
            <?php foreach ($list as $elem) : ?>
              <option
                value="<?= $elem->getId() ?>"
                <?= $elem->getHomeOrder() == 4 ? 'selected' : '' ?>
              >
                <?= $elem->getName() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="home-order-5">5ème catégorie</label>
          <select class="form-control" id="home-order-5" name="home-order[]">
            <option value="0">A sélectionner</option>
            <?php foreach ($list as $elem) : ?>
              <option
                value="<?= $elem->getId() ?>"
                <?= $elem->getHomeOrder() == 5 ? 'selected' : '' ?>
              >
                <?= $elem->getName() ?>
              </option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
    </div>

  </form>
</main>