<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\CoreController;

class UserController extends CoreController {
    
    /**
     * Method to display the login page
     *
     * @return void
     */
    public function login()
    {  
        $this->show(
            'frontoffice',
            'user/loginForm',
            [
                'headTitle' => 'Connexion',
            ]
        );
    }

    /**
     * Method to check the log informations sent via the form and log eventually
     * 
     * @return void
     */
    public function loginPost() 
    {
        dump($_POST);
        
        // we'll need $router to redirect
        global $router;

        // and an array to contain messages
        $message = [];

        // data validation
        // https://www.php.net/manual/fr/filter.filters.sanitize.php
        if (isset($_POST)) {
            if (array_key_exists('email', $_POST)) {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            }
            if (array_key_exists('password', $_POST)) {
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        // save user data in session - for security reason we only send the email back
        $_SESSION['frontoffice']['formData']['email'] = $email;


        // get the user in DB
    }

}