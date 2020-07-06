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