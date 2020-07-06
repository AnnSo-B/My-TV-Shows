<?php

/************************************************************************\
|                         Backoffice User Routes                         |
\************************************************************************/

/**
 * Route to series list page
 */
$router->map(
  'GET',
  '/backoffice/user/list',
  [
      'method' => 'list',
      'controller' => '\App\Controllers\Backoffice\UserController'
  ],
  'backoffice-user-list'
);

/**
 * Route to add a new user form
 */
$router->map(
  'GET',
  '/backoffice/user/add',
  [
      'method' => 'add',
      'controller' => '\App\Controllers\Backoffice\UserController'
  ],
  'backoffice-user-add'
);