<?php
dump($formData['homeCategorySelection']);
?>

<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-main-home') ?>">Retour</a>
  <h2>Sélection des catégories affichées sur la page d'accueil</h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <form action="<?= $router->generate('backoffice-category-selection-post') ?>" method="POST">
    <input type="hidden" id="csrfToken" name="csrfToken" value="<?= $csrfToken ?>"/>

    <!-- First and second category are on the same row -->
    <div class="row">
      <?php for ($index = 1; $index < 3; $index++) : ?>
        <div class="col">
          <div class="form-group">
            <label for="home-order-<?= $index ?>">Catégorie #<?= $index ?></label>
            <select class="form-control" id="home-order-<?= $index ?>" name="home_order[]">
              <option value="">A sélectionner</option>
              <?php foreach ($list as $elem) : ?>
                <option
                  value="<?= $elem->getId() ?>"
                  <?= $elem->getHomeOrder() == $index ? 'selected' : '' ?>
                >
                  <?= $elem->getName() ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
      <?php endfor ?>
    </div>

    <!-- Third, fourth and fifth category are on the same row -->
    <div class="row">
      <?php for ($index = 3; $index < 6; $index++) : ?>
        <div class="col">
          <div class="form-group">
            <label for="home-order-<?= $index ?>">Catégorie #<?= $index ?></label>
            <select class="form-control" id="home-order-<?= $index ?>" name="home_order[]">
              <option value="">A sélectionner</option>
              <?php foreach ($list as $elem) : ?>
                <option
                  value="<?= $elem->getId() ?>"
                  <?= $elem->getHomeOrder() == $index ? 'selected' : '' ?>
                >
                  <?= $elem->getName() ?>
                </option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
      <?php endfor ?>
    
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </form>
</main>