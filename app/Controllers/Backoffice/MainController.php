<?php

namespace App\Controllers\Backoffice;

use App\Controllers\CoreController;

class MainController extends CoreController {
    /**
     * Method to display the backoffice homepage
     *
     * @return void
     */
    public function home() {  
        $this->show('backoffice', 'main/home');
    }
}
