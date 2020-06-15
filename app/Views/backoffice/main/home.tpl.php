<main class="main">
  <section class="my-4 intro">
    <h1 class="mb-1">Bienvenue sur le backoffice</h1>
    <p class="intro__description">Vous souhaitez atteindre...</p>
  </section>
  
  <section class="container">
  <div class="col-7 m-auto d-flex align-items-center flex-wrap">
        <a class="btn btn-primary mx-auto justify-content-lg-between my-1 selection-button" href="#">Les séries</a>
        <a class="btn btn-primary mx-auto justify-content-lg-between my-1 selection-button" href="<?= $router->generate('backoffice-category-list') ?>">Les catégories</a>
        <a class="btn btn-primary mx-auto justify-content-lg-between my-1 selection-button" href="#">Les acteurs</a>
      
      </div>
    </div>
  </section>
</main>