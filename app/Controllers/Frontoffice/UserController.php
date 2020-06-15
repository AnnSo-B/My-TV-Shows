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

}