<?php

namespace App\Controllers;

class CoreController {
   /**
     * Method to display the views
     *
     * @param string $office front or back ? will determine the subfolder
     * @param string $viewName name of the view template
     * @param array $viewVars Array of data to be sent to the view
     * @return void
     */
    protected function show(string $office, string $viewName, $viewVars = []) {
        // Data to be sent to every single page
        $viewVars['currentPage'] = $viewName; 
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        // https://www.php.net/manual/fr/function.extract.php
        // extract transforms array keys into variables
        extract($viewVars);

        // the different templates that will compose the view
        require_once __DIR__.'/../Views/' . $office . '/layout/header.tpl.php';
        require_once __DIR__.'/../Views/' . $office . '/' .$viewName.'.tpl.php';
        require_once __DIR__.'/../Views/' . $office . '/layout/footer.tpl.php';
    }
}