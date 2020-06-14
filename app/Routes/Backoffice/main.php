<?php

/**
 * Route to backoffice homepage
 */
$router->map(
    'GET',
    '/backoffice',
    [
        'method' => 'home',
        'controller' => '\App\Controllers\Backoffice\MainController'
    ],
    'backoffice-main-home'
);