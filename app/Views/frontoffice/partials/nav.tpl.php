<nav class="frontoffice-nav">
  <a class="logo" href="<?= $router->generate('frontoffice-main-home') ?>">My TV-Shows</a>
  <ul class="nav-links">
    <li class="front-nav-item">
      <a class="nav-link" href="<?= $router->generate('frontoffice-main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
    </li>
    <li class="front-nav-item">
      <a class="nav-link" href="#">Toutes les séries</a>
    </li>
    <li class="front-nav-item">
      <a class="nav-link" href="#">Toutes les catégories</a>
    </li>
    <?php if (!isset($_SESSION['userId'])) : ?>
      <li class="front-nav-item">
        <a class="nav-link" href="<?= $router->generate('frontoffice-user-signup') ?>">S'inscrire</a>
      </li>
    <?php endif ?>
    <?php if (!isset($_SESSION['userId'])) : ?>
      <li class="front-nav-item">
        <a class="nav-link" href="<?= $router->generate('frontoffice-user-login') ?>">Connexion</a>
      </li>
    <?php endif ?>
    <?php if (isset($_SESSION['userId'])) : ?>
      <li class="front-nav-item">
        <a class="nav-link" href="<?= $router->generate('frontoffice-user-profil', ['id' => $_SESSION['userId']]) ?>">Mon compte</a>
      </li>
    <?php endif ?>
    <?php if (isset($_SESSION['userId']) && $_SESSION['userData']->getRoleId() == 1) : ?>
      <li class="front-nav-item">
        <a class="nav-link" href="<?= $router->generate('backoffice-main-home') ?>">Backoffice</a>
      </li>
    <?php endif ?>
    <?php if (isset($_SESSION['userId'])) : ?>
      <li class="front-nav-item">
        <a class="nav-link" href="<?= $router->generate('frontoffice-user-logout') ?>">Déconnexion</a>
      </li>
    <?php endif ?>
  </ul>
  <div class="burger">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>
</nav>