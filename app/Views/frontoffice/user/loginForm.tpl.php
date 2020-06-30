<section class="frontoffice-intro">
  <h1 class="frontoffice-intro__title">My TV Shows</h1>
</section>

<section>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
</section>

<section>
  <form class="frontoffice-login-form" action="<?= $router->generate('frontoffice-user-login-post') ?>" method="POST">
    <h2 class="form__title">Formulaire de connexion</h2>
    <input type="hidden" id="csrfToken" name="csrfToken" value="<?= $csrfToken ?>"/>
    <div class="field">
      <label class="field__label" for="email">E-mail</label>
      <input class="field__input" type="email" class="form-control" id="email" aria-describedby="category-email" name="email" value="<?= $formData['email'] ?>">
      <small id="category-email" class="form-text text-muted"></small>
    </div>
    <div class="field">
      <label class="field__label" for="password">Mot de passe</label>
      <input class="field__input" type="password" class="form-control" id="password" aria-describedby="category-password" name="password" value="">
      <small id="category-password" class="form-text text-muted"></small>
    </div>
    <button type="submit" class="form__button">Envoyer</button>
  </form>
</section>
