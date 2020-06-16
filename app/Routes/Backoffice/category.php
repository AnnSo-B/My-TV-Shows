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

/**
 * Route to a form to update a category
 */
$router->map(
  'GET',
  '/backoffice/category/update/[i:id]',
  [
      'method' => 'update',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-update'
);

/**
 * Route to update a category in DB
 */
$router->map(
  'POST',
  // the id is an hidden input
  '/backoffice/category/update',
  [
      'method' => 'updatePost',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-update-post'
);

/**
 * Route to a page displaying the category the user wants to delete
 */
$router->map(
  'GET',
  '/backoffice/category/delete/[i:id]',
  [
      'method' => 'delete',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-delete'
);

/**
 * Route to delete a category in DB
 */
$router->map(
  'POST',
  // the id is an hidden input
  '/backoffice/category/delete',
  [
      'method' => 'deletePost',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-delete-post'
);

/**
 * Route to select the 5 categories displayed in frontoffice homepage
 */
$router->map(
  'GET',
  '/backoffice/category/selection',
  [
      'method' => 'selection',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-selection'
);

/**
 * Route to save the 5 selected categories id DB
 */
$router->map(
  'POST',
  '/backoffice/category/selection-post',
  [
      'method' => 'selectionPost',
      'controller' => '\App\Controllers\Backoffice\CategoryController'
  ],
  'backoffice-category-selection-post'
);