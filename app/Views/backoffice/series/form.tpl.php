<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-series-list') ?>">Retour</a>
  <h2>
    <?php
      // if delete is set and it returns true, the user wants to delete a series
      if (isset($delete) && $delete) {
        echo "Suppression";
      } 
      // if series is set and delete is not set, the user wants to update a series
      else if (isset($series) && !isset($delete)) {
        echo "Modification";
      } 
      // otherwise, the user wants to add a series
      else {
        echo "Ajout";
      }  
    ?> d'une série
  </h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <form
    action="<?php
      // if delete is set and it returns true, the user wants to delete a series
      if (isset($delete) && $delete) {
        echo $router->generate('backoffice-series-delete-post');
      } 
      // if series is set and delete is not set, the user wants to update a series
      else if (isset($series) && !isset($delete)) {
        echo $router->generate('backoffice-series-update-post');
      } 
      // otherwise, the user wants to add a series
      else {
        echo $router->generate('backoffice-series-add-post');
      }  
    ?>"
    method="POST"
  >
    <input
      type="hidden"
      id="csrfToken"
      name="csrfToken"
      value="<?= $csrfToken ?>"
    />
    <?php if (isset($series)) : ?>
      <input
        type="hidden"
        id="id"
        name="id"
        value="<?=
          isset($series)
            ? $series->getId()
            : $formData['id']
        ?>"
      >
    <?php endif ?>
    <div class="form-group">
      <label for="title">Titre</label>
      <input
        type="text"
        class="form-control"
        id="title"
        aria-describedby="series-title"
        name="title"
        value="<?php 
          // if $series doesn't existe, we are in the add form
          if (!isset($series)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['title'];
          } 
          // if there is an $series coming from the view, 
          else {
            // if $formData['title'] value is empty
            if ($formData['title'] === "") {
              // we want to display what come from $series
              echo $series->getTitle();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['title'];
            }
          } 
        ?>"
        <?php 
          // if the user wants to delete the series, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="series-title" class="form-text text-muted">64 caractères maximum</small>
    </div>
    <div class="form-group">
      <label for="synopsis">Synopsis</label>
      <textarea
        class="form-control"
        id="synopsis"
        aria-describedby="series-synopsis"
        rows="3"
        name="synopsis"
        <?php 
          // if the user wants to delete the series, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
        <?php 
          // if $series doesn't existe, we are in the add form
          if (!isset($series)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['synopsis'];
          } 
          // if there is an $series coming from the view, 
          else {
            // if $formData['description'] value is empty
            if ($formData['synopsis'] === null) {
              // we want to display what come from $series
              echo $series->getSynopsis();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['synopsis'];
            }
          } 
        ?>
      </textarea>
      <small id="series-synopsis" class="form-text text-muted">Résumé de la série</small>
    </div>
    <div class="form-group">
      <label for="picture">Image</label>
      <input
        type="text"
        class="form-control"
        id="picture"
        aria-describedby="series-picture"
        name="picture"
        value="<?php 
          // if $series doesn't existe, we are in the add form
          if (!isset($series)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['picture'];
          } 
          // if there is an $series coming from the view, 
          else {
            // if $formData['picture'] value is empty
            if ($formData['picture'] === "") {
              // we want to display what come from $series
              echo $series->getPicture();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['picture'];
            }
          } 
        ?>"
        <?php 
          // if the user wants to delete the series, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="series-picture" class="form-text text-muted">128 caractères maximum - Il s'agit ici du chemin vers l'image</small>
    </div>
    <div class="form-group">
      <label for="title">Année de première diffusion</label>
      <input
        type="text"
        class="form-control"
        id="release-year"
        aria-describedby="series-release-year"
        name="release_year"
        value="<?php 
          // if $series doesn't existe, we are in the add form
          if (!isset($series)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['releaseYear'];
          } 
          // if there is an $series coming from the view, 
          else {
            // if $formData['releaseYear'] value is empty
            if ($formData['releaseYear'] === null) {
              // we want to display what come from $series
              echo $series->getReleaseYear();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['releaseYear'];
            }
          } 
        ?>"
        <?php 
          // if the user wants to delete the series, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="series-title" class="form-text text-muted">sur 4 caractères - tel que 1999 ou 2019</small>
    </div>
    <div class="form-group">
      <label for="status">Statut</label>
      <select
        class="custom-select custom-select-lg mb-3"
        name="status"
        <?php 
          // if the user wants to delete the series, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
        <option
          value="0"
          <?= !isset($series) && $formData['status'] === 0 ? "selected" : "" ?>
        >
          A sélectionner
        </option>
        <option
          value="1"
          <?php
            // if the user want to update a series, $series exists
            if (isset($series)) {
              // if saved in session status is 1, select this option
              if ($formData['status'] === 1) {
                echo "selected";
              }
              // if saved in session status is not 1
              else {
                // if it's 0 and the series status is 1, select this option
                if ($formData['status'] === 0 && $series->getStatus() == 1) {
                  echo "selected";
                }
              }
            } 
            // otherwise -> the user is adding a new series
            // if he already tries to save it and an error occur, saved in session status is 1, so select this option
            else if (!isset($series) && $formData['status'] === 1) {
              // we select this option
              echo "selected";
            }
          ?>
        >
          Actif
        </option>
        <option
          value="2"
          <?php
            // if the user want to update a series, $series exists
            if (isset($series)) {
              // if saved in session status is 2, select this option
              if ($formData['status'] === 2) {
                echo "selected";
              }
              // if saved in session status is not 2
              else {
                // if it's 0 and the series status is 2, select this option
                if ($formData['status'] === 0 && $series->getStatus() == 2) {
                  echo "selected";
                }
              }
            } 
            // otherwise -> the user is adding a new series
            // if he already tries to save it and an error occur, saved in session status is 2, so select this option
            else if (!isset($series) && $formData['status'] === 2) {
              // we select this option
              echo "selected";
            }
          ?>
        >
          Inactif
        </option>
      </select>
    </div>
    <div class="form-group">
      <label for="series-category">Catégorie</label>
      <select
        class="custom-select custom-select-lg mb-3"
        id="series-category"
        name="series_category"
        <?php 
          // if the user wants to delete the series, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
        <option 
          value="0"
          <?= !isset($series) && $formData['seriesCategory'] === 0 ? "selected" : "" ?>
        >
          A sélectionner
        </option>
        <?php foreach ($categoryList as $category) : ?>
          <option
            value="<?= $category->getId() ?>"
            <?php
            if (isset($series)) {
              if (
                $formData['seriesCategory'] === 0
                && $series->getCategoryId() == $category->getId()
              ) {
                echo "selected";
              }
              else if (
                $formData['seriesCategory'] == $category->getId()
              ) {
                echo "selected";
              }
            }
            else if (
              !isset($series) 
              && $formData['seriesCategory'] == $category->getId()
            ) {
              echo "selected";
            }
            ?>
          >
            <?= $category->getName() ?>
          </option>
        <?php endforeach ?>
      </select>
    </div>
    <button
      type="submit"
      class="btn btn-<?= isset($delete) && $delete ? "danger" : "primary" ?>"
    >
      <?= isset($delete) && $delete ? "Supprimer" : "Envoyer" ?>
  </button>
  </form>
</main>