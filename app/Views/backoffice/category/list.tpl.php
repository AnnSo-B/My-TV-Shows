<?php
dump($list)
?>

<main class="container my-4">
  <a class="btn btn-success float-right" href="#">Ajouter</a>
  <h2>Liste des catégories</h2>
  <table class="table table-striped table-responsive">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nom</th>
        <th scope="col">Description</th>
        <th scope="col">Image</th>
        <th scope="col">Position page accueil</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Romance</td>
        <td>Du rire, des larmes et des happy endings !</td>
        <td>assets/images/romance.jpg</td>
        <td>1</td>
        <td>
          <!-- action buttons -->
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-warning mx-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-danger mx-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Oui, supprimer.</a>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th scope="row">1</th>
        <td>Romance</td>
        <td>Du rire, des larmes et des happy endings !</td>
        <td>assets/images/romance.jpg</td>
        <td>1</td>
        <td>
          <!-- action buttons -->
          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-warning mx-2"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
            <div class="btn-group" role="group">
              <button id="btnGroupDrop1" type="button" class="btn btn-danger mx-2 dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </button>
              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                <a class="dropdown-item" href="#">Oui, supprimer.</a>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</main>