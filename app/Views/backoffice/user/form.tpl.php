<main class="container my-4">
  <a class="btn btn-success float-right" href="<?= $router->generate('backoffice-user-list') ?>">Retour</a>
  <h2>
    <?php
      // if delete is set and it returns true, the user wants to delete a user
      if (isset($delete) && $delete) {
        echo "Suppression";
      } 
      // if elem is set and delete is not set, the user wants to update a user
      else if (isset($elem) && !isset($delete)) {
        echo "Modification";
      } 
    ?> d'un utilisateur
  </h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <form
    action="<?php
      // if delete is set and it returns true, the user wants to delete a user
      if (isset($delete) && $delete) {
        echo 'route to create';
      } 
      // if elem is set and delete is not set, the user wants to update a user
      else if (isset($elem) && !isset($delete)) {
        echo 'route to create';
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
    <!-- email -->
    <div class="form-group">
      <label for="email">E-mail</label>
      <input
        type="text"
        class="form-control"
        id="email"
        aria-describedby="user-email"
        name="email"
        value="<?php 
          // if $formData['email'] value is empty
          if ($formData['email'] === "") {
            // we want to display what come from $elem
            echo $elem->getEmail();
          }
          // otherwise it contains user data and we want to use it
          else {
            echo $formData['email'];
          }
        ?>"
        <?php 
          // if the user wants to delete the user, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="user-email" class="form-text text-muted">64 caractères maximum</small>
    </div>
    <!-- firstname -->
    <div class="form-group">
      <label for="firstname">Prénom</label>
      <input
        type="text"
        class="form-control"
        id="firstname"
        aria-describedby="user-firstname"
        name="firstname"
        value="<?php 
          // if $formData['firstname'] value is empty
          if ($formData['firstname'] === "") {
            // we want to display what come from $elem
            echo $elem->getFirstname();
          }
          // otherwise it contains user data and we want to use it
          else {
            echo $formData['firstname'];
          }
        ?>"
        <?php 
          // if the user wants to delete the user, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="user-firstname" class="form-text text-muted">64 caractères maximum</small>
    </div>
    <!-- lastname -->
    <div class="form-group">
      <label for="lastname">Nom</label>
      <input
        type="text"
        class="form-control"
        id="lastname"
        aria-describedby="user-lastname"
        name="lastname"
        value="<?php 
          // if $formData['lastname'] value is empty
          if ($formData['lastname'] === "") {
            // we want to display what come from $elem
            echo $elem->getLastname();
          }
          // otherwise it contains user data and we want to use it
          else {
            echo $formData['lastname'];
          }
        ?>"
        <?php 
          // if the user wants to delete the user, he can't change its
          if (isset($delete) && $delete) {
            echo "disabled";
          } 
        ?>
      >
      <small id="user-lastname" class="form-text text-muted">64 caractères maximum</small>
    </div>
    <!-- status -->
    <div class="form-group">
      <label for="status">Statut</label>
      <select
        class="custom-select custom-select-lg mb-3"
        name="status"
        <?php 
          // if the user wants to delete the user, he can't change its
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
            // if the user want to update a user, $elem exists
            if (isset($elem)) {
              // if saved in session status is 1, select this option
              if ($formData['status'] === 1) {
                echo "selected";
              }
              // if saved in session status is not 1
              else {
                // if it's 0 and the user status is 1, select this option
                if ($formData['status'] === 0 && $elem->getStatus() == 1) {
                  echo "selected";
                }
              }
            } 
            // otherwise -> the user is adding a new user
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
            // if the user want to update a user, $elem exists
            if (isset($elem)) {
              // if saved in session status is 2, select this option
              if ($formData['status'] === 2) {
                echo "selected";
              }
              // if saved in session status is not 2
              else {
                // if it's 0 and the user status is 2, select this option
                if ($formData['status'] === 0 && $elem->getStatus() == 2) {
                  echo "selected";
                }
              }
            } 
            // otherwise -> the user is adding a new user
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