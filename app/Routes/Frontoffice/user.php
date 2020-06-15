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

/**
 * Route to log user in
 */
$router->map(
    'POST',
    '/login',
    [
        'method' => 'loginPost',
        'controller' => '\App\Controllers\Frontoffice\UserController'
    ],
    'frontoffice-user-login-post'
);