<?php

/************************************************************************\
|                               User Routes                              |
\************************************************************************/

/**
 * Route to login form
 */
$router->map(
  'GET',
  '/login',
  [
      'method' => 'login',
      'controller' => '\App\Controllers\Frontoffice\UserController'
  ],
  'frontoffice-user-login'
);
