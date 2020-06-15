<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-category-list') ?>">Retour</a>
  <h2>
    <?php
      // if delete is set and it returns true, the user wants to delete a category
      if (isset($delete) && $delete) {
        echo "Suppression";
      } 
      // if elem is set and delete is not set, the user wants to update a category
      else if (isset($elem) && !isset($delete)) {
        echo "Modification";
      } 
      // otherwise, the user wants to add a category
      else {
        echo "Ajout";
      }  
    ?> d'une catégorie
  </h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <form
    action="<?php
      // if delete is set and it returns true, the user wants to delete a category
      if (isset($delete) && $delete) {
        echo $router->generate('backoffice-category-delete-post');
      } 
      // if elem is set and delete is not set, the user wants to update a category
      else if (isset($elem) && !isset($delete)) {
        echo $router->generate('backoffice-category-update-post');
      } 
      // otherwise, the user wants to add a category
      else {
        echo $router->generate('backoffice-category-add-post');
      }  
    ?>"
    method="POST"
  >
    <?php if (isset($elem)) : ?>
      <input
        type="hidden"
        id="id"
        name="id"
        value="<?=
          isset($elem)
            ? $elem->getId()
            : $formData['id']
        ?>"
      >
    <?php endif ?>
    <div class="form-group">
      <label for="name">Nom</label>
      <input
        type="text"
        class="form-control"
        id="name"
        aria-describedby="category-name"
        name="name"
        value="<?php 
          // if $elem doesn't existe, we are in the add form
          if (!isset($elem)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['name'];
          } 
          // if there is an $elem coming from the view, 
          else {
            // if $formData['name'] value is empty
            if ($formData['name'] === "") {
              // we want to display what come from $elem
              echo $elem->getName();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['name'];
            }
          } 
        ?>"
        <?php 
          // if the user wants to delete the category, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="category-name" class="form-text text-muted">64 caractères maximum</small>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input
        type="text"
        class="form-control"
        id="description"
        aria-describedby="category-description"
        name="description"
        value="<?php 
          // if $elem doesn't existe, we are in the add form
          if (!isset($elem)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['description'];
          } 
          // if there is an $elem coming from the view, 
          else {
            // if $formData['description'] value is empty
            if ($formData['description'] === "") {
              // we want to display what come from $elem
              echo $elem->getDescription();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['description'];
            }
          } 
        ?>"
        <?php 
          // if the user wants to delete the category, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="category-description" class="form-text text-muted">64 caractères maximum - Permettra de mettre une petite info sur la catégorie</small>
    </div>
    <div class="form-group">
      <label for="picture">Image</label>
      <input
        type="text"
        class="form-control"
        id="picture"
        aria-describedby="category-picture"
        name="picture"
        value="<?php 
          // if $elem doesn't existe, we are in the add form
          if (!isset($elem)) {
            // the input has to be take the value of $formData (empty by default - see CoreController show Method)
            echo $formData['picture'];
          } 
          // if there is an $elem coming from the view, 
          else {
            // if $formData['picture'] value is empty
            if ($formData['picture'] === "") {
              // we want to display what come from $elem
              echo $elem->getPicture();
            }
            // otherwise it contains user data and we want to use it
            else {
              echo $formData['picture'];
            }
          } 
        ?>"
        <?php 
          // if the user wants to delete the category, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="category-picture" class="form-text text-muted">128 caractères maximum - Il s'agit ici du chemin vers l'image</small>
    </div>
    <!-- Home order selection will have its own page -->
    <div class="form-group">
      <label for="status">Statut</label>
      <select
        class="custom-select custom-select-lg mb-3"
        name="status"
        <?php 
          // if the user wants to delete the category, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
        <option
          value="0"
          <?= !isset($elem) && $formData['status'] === 0 ? "selected" : "" ?>
        >
          A sélectionner
        </option>
        <option
          value="1"
          <?php
            // if the user want to update a category, $elem exists
            if (isset($elem)) {
              // if saved in session status is 1, select this option
              if ($formData['status'] === 1) {
                echo "selected";
              }
              // if saved in session status is not 1
              else {
                // if it's 0 and the category status is 1, select this option
                if ($formData['status'] === 0 && $elem->getStatus() == 1) {
                  echo "selected";
                }
              }
            } 
            // otherwise -> the user is adding a new category
            // if he already tries to save it and an error occur, saved in session status is 1, so select this option
            else if (!isset($elem) && $formData['status'] === 1) {
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
            // if the user want to update a category, $elem exists
            if (isset($elem)) {
              // if saved in session status is 2, select this option
              if ($formData['status'] === 2) {
                echo "selected";
              }
              // if saved in session status is not 2
              else {
                // if it's 0 and the category status is 2, select this option
                if ($formData['status'] === 0 && $elem->getStatus() == 2) {
                  echo "selected";
                }
              }
            } 
            // otherwise -> the user is adding a new category
            // if he already tries to save it and an error occur, saved in session status is 2, so select this option
            else if (!isset($elem) && $formData['status'] === 2) {
              // we select this option
              echo "selected";
            }
          ?>
        >
          Inactif
        </option>
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