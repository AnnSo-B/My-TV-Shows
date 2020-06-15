<?php

/**
 * Route to frontoffice homepage
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