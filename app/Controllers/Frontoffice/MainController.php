<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\CoreController;

class MainController extends CoreController {
    /**
     * Method to display the backoffice homepage
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
}