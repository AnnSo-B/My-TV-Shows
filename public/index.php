<?php

/************************************************************************\
|                          Composer dependencies                         |
\************************************************************************/
// To init --> composer dump-autoload
require_once '../vendor/autoload.php';

/************************************************************************\
|                              Start Session                             |
\************************************************************************/
session_start();

/************************************************************************\
|                                Routing                                 |
\************************************************************************/
/**
 * @var Object $router Altorouter Object
 */
$router = new AltoRouter();


/**
 * If the project lives in a sub-folder of the web root, use the setBasePath() 
 * method to set a base path.
 */
if (array_key_exists('BASE_URI', $_SERVER)) {
    $router->setBasePath($_SERVER['BASE_URI']);
}
/**
 * Else, set Base Uri default value
 */
else {
    $_SERVER['BASE_URI'] = '/';
}

/**
 * Require the route file
 */
require_once '../app/Routes/routes.php'; 

/************************************************************************\
|                              Dispatching                               |
\************************************************************************/
/**
 * Find a matching route thanks to altorouter
 */
$match = $router->match();

/**
 * Create an instanciation of Dispatcher
 */
$dispatcher = new Dispatcher($match, 'App\Controllers\\Frontoffice\MainController::error404');

/**
 * Execute dispatch method from Dispatcher class
 */
$dispatcher->dispatch();
