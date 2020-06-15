<?php

/**
 * Route to frontoffice homepage
 */
$router->map(
    'GET',
    '/',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\Frontoffice\MainController'
    ],
    'frontoffice-main-home'
);

/**
 * Route to error 404
 */
$router->map(
    'GET',
    '/error404',
    [
        'method' => 'error404',
        'controller' => '\App\Controllers\Frontoffice\MainController'
    ],
    'frontoffice-main-error404'
);

/**
 * Route to error 403
 */
$router->map(
    'GET',
    '/error403',
    [
        'method' => 'error403',
        'controller' => '\App\Controllers\Frontoffice\MainController'
    ],
    'frontoffice-main-error403'
);