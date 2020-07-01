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
                    // redirect to homepage
                    $redirect = $router->generate('frontoffice-main-home');
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
        header('Location: ' . $router->generate('frontoffice-main-home'));
    }
    
    /**
     * Method to display the signup form page
     *
     * @return void
     */
    public function signup()
    {  
        $this->show(
            'frontoffice',
            'user/signupForm',
            [
                'headTitle' => 'S\'inscrire',
            ]
        );
    }
    
    /**
     * Method to display the signup a new user
     *
     * @return void
     */
    public function signupPost()
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
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($email) > 64) {
                    $message['email_failure'] = 'Votre e-mail ne peut excéder 64 caractères.';                
                }
                else if (strlen($email) < 1) {
                    $message['email_failure'] = 'Merci d\'indiquer une adresse email.';                
                }
            }
            if (array_key_exists('firstname', $_POST)) {
                $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($firstname) > 64) {
                    $message['firstname_failure'] = 'Votre prénom ne peut excéder 64 caractères.';                
                }
                else if (strlen($firstname) < 1) {
                    $message['firstname_failure'] = 'Merci d\'indiquer votre prénom.';                
                }
            }
            if (array_key_exists('lastname', $_POST)) {
                $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($lastname) > 64) {
                    $message['lastname_failure'] = 'Votre nom ne peut excéder 64 caractères.';                
                }
                else if (strlen($lastname) < 1) {
                    $message['lastname_failure'] = 'Merci d\'indiquer votre nom.';                
                }
            }
            if (array_key_exists('password', $_POST)) {
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($password) > 15) {
                    $message['password_failure'] = 'Votre mot de passe ne peut excéder 15 caractères.';                
                }
                else if (strlen($password) < 1) {
                    $message['password_failure'] = 'Merci d\'indiquer votre mot de passe.';                
                }
            }
            if (array_key_exists('password-confirmation', $_POST)) {
                $passwordConfirmation = filter_input(INPUT_POST, 'password-confirmation', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($passwordConfirmation) > 15) {
                    $message['password_confirmation_failure'] = 'La confirmation de votre mot de passe ne peut excéder 15 caractères.';                
                }
                else if (strlen($password) < 1) {
                    $message['password_confirmation_failure'] = 'Merci de confirmer votre mot de passe.';                
                }
            }
        }

        // save user data in session - for security reason we won't send password back
        $_SESSION['formData']['email'] = $email;
        $_SESSION['formData']['firstname'] = $firstname;
        $_SESSION['formData']['lastname'] = $lastname;

        // if there are error, save the message in session and redirect to the form
        if (count($message) > 0) {
            // save messages
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('frontoffice-user-signup'));
            exit();
        }
        
        
    }
}