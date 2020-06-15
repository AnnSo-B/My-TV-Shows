<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?= $router->generate('frontoffice-main-home') ?>">My TV-Shows</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= $router->generate('frontoffice-main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <?php if (!isset($_SESSION['userId'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $router->generate('frontoffice-user-login') ?>">Connexion</a>
        </li>
      <?php endif ?>
      <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] === 1) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $router->generate('backoffice-main-home') ?>">Backoffice</a>
        </li>
      <?php endif ?>
      <?php if (isset($_SESSION['userId'])) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $router->generate('frontoffice-user-logout') ?>">Déconnexion</a>
        </li>
      <?php endif ?>
  </div>
</nav>