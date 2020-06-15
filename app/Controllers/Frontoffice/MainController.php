<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\CoreController;

class MainController extends CoreController {

    /**
     * Method to display the frontoffice homepage
     *
     * @return void
     */
    public function home() {  
        $this->show(
            'frontoffice',
            'main/home',
            [
                'headTitle' => 'Bienvenue sur '
            ]
        );
    }

    /**
     * Method to display the 404 page
     *
     * @return void
     */
    public function error404() {  
        $this->show(
            'frontoffice',
            'main/error404',
            [
                'headTitle' => 'Erreur 404'
            ]
        );
    }
    
    /**
     * Method to display the 403 page
     *
     * @return void
     */
    public function error403() {  
        $this->show(
            'frontoffice',
            'main/error403',
            [
                'headTitle' => 'Erreur 403'
            ]
        );
    }
}