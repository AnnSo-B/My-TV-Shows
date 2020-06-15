<main class="container my-4">
  <h2>Formulaire de connexion temporaire pour mise en place authentification pour le backoffice</h2>
  <?php 
    include __DIR__.'/../partials/session_messages.tpl.php';
  ?>
  <form action="<?= $router->generate('frontoffice-user-login-post') ?>" method="POST">
    <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" class="form-control" id="email" aria-describedby="category-email" name="email" value="<?= $formData['email'] ?>">
      <small id="category-email" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input type="password" class="form-control" id="password" aria-describedby="category-password" name="password" value="">
      <small id="category-password" class="form-text text-muted"></small>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </form>
</main>