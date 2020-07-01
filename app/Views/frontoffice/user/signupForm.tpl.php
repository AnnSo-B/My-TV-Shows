<section class="frontoffice-intro">
  <h1 class="frontoffice-intro__title">My TV Shows</h1>
</section>

<section>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
</section>

<section>
  <form class="frontoffice-login-form" action="<?= $router->generate('frontoffice-user-signup-post') ?>" method="POST">
    <h2 class="form__title">Formulaire d'inscription</h2>
    <input type="hidden" id="csrfToken" name="csrfToken" value="<?= $csrfToken ?>"/>
    <!-- include email input -->    
    <?php
      include __DIR__.'/../partials/email_input.tpl.php';
    ?>
    <div class="field">
      <label class="field__label" for="password">Votre pseudonyme</label>
      <input class="field__input" type="password" class="form-control" id="password" aria-describedby="category-password" name="password" value="">
      <small id="category-password" class="form-text text-muted"></small>
    </div>
    <!-- include password input -->    
    <?php
      include __DIR__.'/../partials/password_input.tpl.php';
    ?>
    <div class="field">
      <label class="field__label" for="password">Confirmez votre mot de passe</label>
      <input class="field__input" type="password" class="form-control" id="password" aria-describedby="category-password" name="password" value="">
      <small id="category-password" class="form-text text-muted"></small>
    </div>
    <!-- include submit button -->    
    <?php
      include __DIR__.'/../partials/submit_button.tpl.php';
    ?>
  </form>
</section>
