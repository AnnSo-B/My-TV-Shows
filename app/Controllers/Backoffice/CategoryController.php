<?php

namespace App\Controllers\Backoffice;

use App\Controllers\CoreController;
use App\Models\Category;


class CategoryController extends CoreController
{

    /**
     * Method to display the category list page
     *
     * @return void
     */
    public function list()
    {

        // We extract the list of cateogries from the DB
        $categoryList = Category::findAll();      
        
        // we display the view and the list is sent
        $this->show('backoffice', 'category/list', ['list' => $categoryList]);
    }

    /**
     * Method to display the add form
     * 
     * @return void
     */
    public function add() {

        // we display the form
        // we'll use the same to add and update a category - conditional template
        $this->show('backoffice', 'category/form');
    }
}