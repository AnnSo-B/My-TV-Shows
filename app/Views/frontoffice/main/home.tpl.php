<section class="frontoffice-intro">
  <h1 class="frontoffice-intro__title">Bienvenue sur<br>My TV Shows</h1>
  <p class="frontoffice-intro__info">Pour découvrir de nouvelles séries et ne plus se demander quel est le dernier épisode de votre série préférée que vous avez regardé.</p>
</section>

<section class="frontoffice__home-page__section">
  <h2 class="frontoffice__home-section__title">Les dernières séries</h2>
  <?php foreach ($latestSeries as $series) : ?>
    <article class="frontoffice__home-article">
      <a href="">
        <img
          class="frontoffice__home-article__image"
          src="<?= $assetsBaseUri ?><?= $series->getPicture() ?>"
          alt="<?= $series->getTitle() ?>"
        >
        <h3 class="frontoffice__home-article__title">
          <?= $series->getTitle() ?>
        </h3>
      </a>
    </article>
  <?php endforeach ?>
</section>

<section class="frontoffice__home-page__section">
  <h2 class="frontoffice__home-section__title">Les catégories à la une</h2>
  <?php foreach ($homepageCategories as $category) : ?>
    <article class="frontoffice__home-article">
      <a href="">
        <img
          class="frontoffice__home-article__image"
          src="<?= $assetsBaseUri ?><?= $category->getPicture() ?>"
          alt="<?= $category->getName() ?>"
        >
        <h3 class="frontoffice__home-article__title">
          <?= $category->getName() ?>
        </h3>
      </a>
    </article>
  <?php endforeach ?>
</section>