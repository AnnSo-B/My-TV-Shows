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

        // we need the router
        global $router;
        
        // Data to be sent to every single page
        $viewVars['currentPage'] = $viewName; 
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        // if we have messages in session, 
        if (isset($_SESSION['sessionMessages'])) {
            // we'll want to display them so we send them to the view
            $viewVars['sessionMessages'] = $_SESSION['sessionMessages'];
            // and erase those messages from the session so that new ones can be saved 
            unset($_SESSION['sessionMessages']);
        } else {
            // otherwise we keep an empty sessionMessages array
            $viewVars['sessionMessages'] = [];
        }

        // if we have formData in session, 
        if (isset($_SESSION['formData'])) {
            // we'll want to display them so we send them to the view
            $viewVars['formData'] = $_SESSION['formData'];
            // and erase those messages from the session so that new ones can be saved 
            unset($_SESSION['formData']);
        } else {
            // otherwise we keep an empty formData array
            $viewVars['formData']['id'] = '';
            $viewVars['formData']['name'] = '';
            $viewVars['formData']['description'] = '';
            $viewVars['formData']['picture'] = '';
            $viewVars['formData']['status'] = 0;
        }

        // https://www.php.net/manual/fr/function.extract.php
        // extract transforms array keys into variables
        extract($viewVars);

        // the different templates that will compose the view
        require_once __DIR__.'/../Views/' . $office . '/layout/header.tpl.php';
        require_once __DIR__.'/../Views/' . $office . '/' .$viewName.'.tpl.php';
        require_once __DIR__.'/../Views/' . $office . '/layout/footer.tpl.php';
    }
}