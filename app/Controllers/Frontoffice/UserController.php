<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\CoreController;
use App\Models\User;

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
        $_SESSION['formData']['email'] = $email;

        // get the user in DB
        $currentUser = User::findByEmail($email);

        // if the user doesn't exist
        if (!$currentUser) {
            // we send a message
            $message['unknow-email'] = 'Le mail ne correspond pas à un utilisateur connu. Merci de créer un compte ou vérifier le mail saisi.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // and redirect to the form
            $redirect = $router->generate('frontoffice-user-login');
        }
        // if the user exists
        else {
            // we have to check the password
            // TODO : create a user and hash one password -> it'll change the way of checking the password
            // if the password is not correct
            if ($password !== $currentUser->getPassword()) {
                // we send a message
                $message['unknow-password'] = 'Le mot de passe est incorrect. Merci de le compléter à nouveau.';
    
                // save message in session
                $_SESSION['sessionMessages'] = $message;
    
                // and redirect to the form
                $redirect = $router->generate('frontoffice-user-login');
            }
            // if it is correct
            else {
                // we save user data in session
                $_SESSION['userId'] = $currentUser->getId();
                $_SESSION['userData'] = $currentUser;

                // redirect to home backoffice page if the user is an administrator otherwise to the homepage
                if (intval($currentUser->getRoleId()) === 1) {
                    $redirect = $router->generate('backoffice-main-home');
                }
                else {
                    // TODO : route to homepage to redirect there
                }
            }
        }
                
        // and redirect to the form
        header('Location: ' . $redirect);
    }

    /**
     * Method to log a user out
     */
    public function logout()
    {
        // we have to delete userId and userData from session
        unset($_SESSION['userId']);
        unset($_SESSION['userData']);

        // redirect to login page
      global $router;
      header('Location: ' . $router->generate('frontoffice-user-login'));
    }
}