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
 * Route to a form to update a user
 */
$router->map(
  'GET',
  '/backoffice/user/update/[i:id]',
  [
    'method' => 'update',
    'controller' => '\App\Controllers\Backoffice\UserController'
  ],
  'backoffice-user-update'
);
