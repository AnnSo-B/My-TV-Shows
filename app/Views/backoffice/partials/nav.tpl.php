<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= $router->generate('backoffice-main-home') ?>">Backoffice - My TV-Shows</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= $router->generate('backoffice-main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Séries</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $router->generate('backoffice-category-list') ?>">Catégories</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Acteurs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $router->generate('frontoffice-main-home') ?>">Retour vers le site</a>
      </li>
      <?php if ($_SESSION['userId']) : ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $router->generate('frontoffice-user-logout') ?>">Déconnexion</a>
        </li>
      <?php endif ?>
  </div>
</nav>