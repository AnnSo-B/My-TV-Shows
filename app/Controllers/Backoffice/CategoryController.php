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
    public function add() 
    {

        // we display the form
        // we'll use the same to add and update a category - conditional template
        $this->show('backoffice', 'category/form');
    }

    /**
     * Method to add a new category in DB
     * 
     * @return void
     */
    public function addPost() 
    {

        // data validation
        // https://www.php.net/manual/fr/filter.filters.sanitize.php
        if (isset($_POST)) {
            if (array_key_exists('name', $_POST)) {
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (array_key_exists('description', $_POST)) {
                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (array_key_exists('picture', $_POST)) {
                $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (array_key_exists('status', $_POST)) {
                $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_NUMBER_INT);
            }
        }

        // create entry
        $newCategory = new Category;
        // put a value on each property
        $newCategory->setName($name);
        $newCategory->setDescription($description);
        $newCategory->setPicture($picture);
        $newCategory->setStatus($status);

        dump($newCategory);

        // insert entry
    }
}