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
      <label class="field__label" for="firstname">Votre prénom</label>
      <input class="field__input" type="firstname" class="form-control" id="firstname" aria-describedby="firstname" name="firstname" value="<?= $formData['firstname'] ?>">
      <small id="firstname" class="form-text text-muted"></small>
    </div>
    <div class="field">
      <label class="field__label" for="lastname">Votre nom</label>
      <input class="field__input" type="lastname" class="form-control" id="lastname" aria-describedby="lastname" name="lastname" value="<?= $formData['lastname'] ?>">
      <small id="lastname" class="form-text text-muted"></small>
    </div>
    <!-- include password input -->    
    <?php
      include __DIR__.'/../partials/password_input.tpl.php';
    ?>
    <div class="field">
      <label class="field__label" for="password-confirmation">Confirmez votre mot de passe</label>
      <input class="field__input" type="password" class="form-control" id="password-confirmation" aria-describedby="password-confirmation" name="password-confirmation" value="">
      <small id="password-confirmation" class="form-text text-muted"></small>
    </div>
    <!-- include submit button -->    
    <?php
      include __DIR__.'/../partials/submit_button.tpl.php';
    ?>
  </form>
</section>
