<?php

/************************************************************************\
|                             Series Routes                              |
\************************************************************************/

/**
 * Route to series list page
 */
$router->map(
  'GET',
  '/backoffice/series/list',
  [
      'method' => 'list',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-list'
);


/**
 * Route to add a new series form
 */
$router->map(
  'GET',
  '/backoffice/series/add',
  [
      'method' => 'add',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-add'
);

/**
 * Route to add a new series in DB
 */
$router->map(
  'POST',
  '/backoffice/series/add',
  [
      'method' => 'addPost',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-add-post'
);

/**
 * Route to a form to update a series
 */
$router->map(
  'GET',
  '/backoffice/series/update/[i:id]',
  [
      'method' => 'update',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-update'
);

/**
 * Route to update a series in DB
 */
$router->map(
  'POST',
  // the id is an hidden input
  '/backoffice/series/update',
  [
      'method' => 'updatePost',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-update-post'
);

/**
 * Route to a page displaying the series the user wants to delete
 */
$router->map(
  'GET',
  '/backoffice/series/delete/[i:id]',
  [
      'method' => 'delete',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-delete'
);

/**
 * Route to delete a series in DB
 */
$router->map(
  'POST',
  // the id is an hidden input
  '/backoffice/series/delete',
  [
      'method' => 'deletePost',
      'controller' => '\App\Controllers\Backoffice\SeriesController'
  ],
  'backoffice-series-delete-post'
);
