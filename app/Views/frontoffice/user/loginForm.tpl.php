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
    <!-- include email input -->    
    <?php
      include __DIR__.'/../partials/email_input.tpl.php';
    ?>
    <!-- include password input -->    
    <?php
      include __DIR__.'/../partials/password_input.tpl.php';
    ?>
    <!-- include submit button -->    
    <?php
      include __DIR__.'/../partials/submit_button.tpl.php';
    ?>
  </form>
</section>
