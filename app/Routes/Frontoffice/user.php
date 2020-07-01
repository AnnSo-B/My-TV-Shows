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

/**
 * Route to log user out
 */
$router->map(
  'GET',
  '/logout', 
  [
      'method' => 'logout',
      'controller' => '\App\Controllers\Frontoffice\UserController'
  ],
  'frontoffice-user-logout'
);

/**
 * Route to sign up form
 */
$router->map(
  'GET',
  '/signup',
  [
      'method' => 'signup',
      'controller' => '\App\Controllers\Frontoffice\UserController'
  ],
  'frontoffice-user-signup'
);

/**
 * Route to sign up a new user
 */
$router->map(
  'POST',
  '/signup',
  [
      'method' => 'signupPost',
      'controller' => '\App\Controllers\Frontoffice\UserController'
  ],
  'frontoffice-user-signup-post'
);