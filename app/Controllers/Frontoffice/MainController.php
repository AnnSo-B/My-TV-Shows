<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\CoreController;
use App\Models\Category;
use App\Models\Series;

class MainController extends CoreController {

    /**
     * Method to display the frontoffice homepage
     *
     * @return void
     */
    public function home() {  
        // get the 5 latest series
        $latestSeries = Series::findLatestSeries();

        // get the 5 homepage categories
        $homepageCategories = Category::findHomepageCategories();

        $this->show(
            'frontoffice',
            'main/home',
            [
                'headTitle' => 'Bienvenue sur ',
                'latestSeries' => $latestSeries,
                'homepageCategories' => $homepageCategories
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