<?php

/************************************************************************\
|                           Category Routes                              |
\************************************************************************/

/**
 * Route to category list page
 */
$router->map(
  'GET',
  '/backoffice/category/list',
  [
      'method' => 'list',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-list'
);


/**
 * Route to add a new category form
 */
$router->map(
  'GET',
  '/backoffice/category/add',
  [
      'method' => 'add',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-add'
);

/**
 * Route to add a new category in DB
 */
$router->map(
  'POST',
  '/backoffice/category/add',
  [
      'method' => 'addPost',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-add-post'
);
