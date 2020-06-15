<?php

namespace App\Controllers;

class CoreController {

    /**
     * Method launched every time a new object is instanciated
     */
    public function __construct()
    {
        //* check the authorization for the current page
        // we need $match variable which contains the page name
        global $match;

        // get the route name
        $currentRoute = $match['name'];

        // include the access control list
        require __DIR__ . '../../Routes/acl.php';

        // if the route is in the access control list, we'll want to check the user is authorized to see it
        if (array_key_exists($currentRoute, $controlList)) {
            // checkAuthorization needs the list as argument
            $this->checkAuthorization($controlList[$currentRoute]);
        }

        // * check the token
        // List of CSRF protected Router
        require __DIR__ . '../../Routes/csrfProtectedRoute.php';
        
        // if the route is protected by token 
        if (in_array($currentRoute, $csrfProtectedRoute)) {
            // get the token send by the previous view
            if (isset($_GET['csrfToken'])) {
                $receivedToken = $_GET['csrfToken'];
            } else if (isset($_POST['csrfToken'])) {
                $receivedToken = $_POST['csrfToken'];
            }
            // and check the token
            $this->checkCsrfToken($receivedToken);
        }
    }


   /**
     * Method to display the views
     *
     * @param string $office front or back ? will determine the subfolder
     * @param string $viewName name of the view template
     * @param array $viewVars Array of data to be sent to the view
     * @return void
     */
    protected function show(string $office, string $viewName, $viewVars = []) 
    {

        // we need the router
        global $router;
        
        //* Data to be sent to every single page
        $viewVars['currentPage'] = $viewName; 
        $viewVars['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        $viewVars['baseUri'] = $_SERVER['BASE_URI'];

        //* Token generation
        // create one
        $this->generateCsrfToken();
        // and send it to the view
        $viewVars['csrfToken'] = $_SESSION['csrfToken'];

        //* if we have messages in session, 
        if (isset($_SESSION['sessionMessages'])) {
            // we'll want to display them so we send them to the view
            $viewVars['sessionMessages'] = $_SESSION['sessionMessages'];
            // and erase those messages from the session so that new ones can be saved 
            unset($_SESSION['sessionMessages']);
        } else {
            // otherwise we keep an empty sessionMessages array
            $viewVars['sessionMessages'] = [];
        }

        //* if we have formData in session, 
        if (isset($_SESSION['formData'])) {
            // we'll want to display them so we send them to the view
            $viewVars['formData'] = $_SESSION['formData'];
            // and erase those data from the session so that new ones can be saved 
            unset($_SESSION['formData']);
        } else {
            // otherwise we keep an empty formData array which contains every input existing in the app to reset all the data in session
            $viewVars['formData']['description'] = '';
            $viewVars['formData']['email'] = '';
            $viewVars['formData']['id'] = '';
            $viewVars['formData']['name'] = '';
            $viewVars['formData']['picture'] = '';
            $viewVars['formData']['status'] = 0;
        }

        //* extract transforms array keys into variables
        // https://www.php.net/manual/fr/function.extract.php
        extract($viewVars);

        //* the different templates that will compose the view
        require_once __DIR__.'/../Views/' . $office . '/layout/header.tpl.php';
        require_once __DIR__.'/../Views/' . $office . '/' .$viewName.'.tpl.php';
        require_once __DIR__.'/../Views/' . $office . '/layout/footer.tpl.php';
    }

    /**
     * Method to check user authorization
     * 
     * @param $accessControlList
     * @return bool either the user is authorized to display the current page
     */
    protected function checkAuthorization($roles = [])
    {
        // we need the router
        global $router;

        // if the user is connected, we can find his data in session
        if (array_key_exists('userId', $_SESSION) && array_key_exists('userData', $_SESSION)) {
            // if the user role is included in the authorized roles
            if (in_array($_SESSION['userData']->getRoleId(), $roles)) {
                // he is authorized to continue on this page
                return true;
            }
            else {
                // we want to redirect the user to the 403 error page
                $redirect = $router->generate('frontoffice-main-error403');
            }
        }
        // if the user is not connected
        else {
            // redirect to the login form
            $redirect = $router->generate('frontoffice-user-login');
        }

        // redirection
        header('Location: ' . $redirect);
    }

    /**
     * Method to generate a random CSRF Token
     *
     * @return string
     */
    private function generateCsrfToken()
    {
        // https://www.php.net/manual/fr/function.uniqid.php
        // https://www.php.net/manual/fr/function.bin2hex
        $_SESSION['csrfToken'] = uniqid(rand(), true) . bin2hex(random_bytes(32)) . uniqid(rand(), true);

        return $_SESSION['csrfToken'];
    }

    /**
     * Method to check CSRF Token
     * 
     * @return
     */
    private function checkCsrfToken($receivedToken) 
    {
        // we need the router
        global $router;

        // we retrieve the token in session
        $sessionToken = $_SESSION['csrfToken'];

        // if receive token is empty or different from the token saved in session
        if (empty($receivedToken) || $receivedToken !== $sessionToken) {
            // we want to redirect the user to the 403 error page
            header('Location: ' . $router->generate('frontoffice-main-error403'));
            exit();
        }
        // otherwise, it's ok
        else {
            // we delete the token in session and a new one will be created the next time a page will be constructed
            unset($_SESSION['csrfToken']);
        }
    }
}