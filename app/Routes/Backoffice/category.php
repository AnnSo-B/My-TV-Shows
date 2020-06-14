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
