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
        exit();
    }

}