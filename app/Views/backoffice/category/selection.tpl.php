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
      <?php for ($index = 0; $index < 2; $index++) : ?>
        <div class="col">
          <div class="form-group">
            <label for="home-order-<?= $index + 1 ?>">Catégorie #<?= $index + 1 ?></label>
            <select class="form-control" id="home-order-<?= $index + 1 ?>" name="home_order[]">
              <option 
                value=""
              >
                A sélectionner
              </option>
              <?php foreach ($list as $elem) : ?>
                <option
                  value="<?= $elem->getId() ?>"
                  <?php
                    if (
                      $formData['homeCategorySelection'] === []
                      && $elem->getHomeOrder() == ($index + 1)
                    ) {
                      echo "selected";
                    }
                    else if (
                      $formData['homeCategorySelection'] !== []
                      && $formData['homeCategorySelection'][$index] == $elem->getId()
                    ) {
                      echo "selected";
                    }
                  ?>
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
      <?php for ($index = 2; $index < 5; $index++) : ?>
        <div class="col">
          <div class="form-group">
            <label for="home-order-<?= $index + 1 ?>">Catégorie #<?= $index + 1 ?></label>
            <select class="form-control" id="home-order-<?= $index + 1 ?>" name="home_order[]">
              <option value="">A sélectionner</option>
              <?php foreach ($list as $elem) : ?>
                <option
                  value="<?= $elem->getId() ?>"
                  <?php
                    if (
                      $formData['homeCategorySelection'] === []
                      && $elem->getHomeOrder() == ($index + 1)
                    ) {
                      echo "selected";
                    }
                    else if (
                      $formData['homeCategorySelection'] !== []
                      && $formData['homeCategorySelection'][$index] == $elem->getId()
                    ) {
                      echo "selected";
                    }
                  ?>
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