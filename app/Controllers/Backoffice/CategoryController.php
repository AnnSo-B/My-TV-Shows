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

        // we need the router to redirect
        global $router;

        // data validation
        // https://www.php.net/manual/fr/filter.filters.sanitize.php
        if (isset($_POST)) {
            if (array_key_exists('name', $_POST)) {
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($name) > 64) {
                    $message['name_failure'] = 'Le nom d\'une catégorie ne peut excéder 64 caractères.';                
                }
                else if (strlen($name) < 1) {
                    $message['name_failure'] = 'Merci d\'indiquer le nom de la catégorie.';                
                }
            }
            if (array_key_exists('description', $_POST)) {
                $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($description) > 64) {
                    $message['description_failure'] = 'La description d\'une catégorie ne peut excéder 128 caractères.';
                }
            }
            if (array_key_exists('picture', $_POST)) {
                $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($picture) > 128) {
                    $message['picture_failure'] = 'La description d\'un produit ne peut excéder 128 caractères.';
                }
            }
            if (array_key_exists('status', $_POST)) {
                $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT, [1, 2]);
                // https://www.php.net/manual/fr/function.strlen.php
                if (!$status) {
                    $message['status_failure'] = 'Ce statut n\'est pas valide.';
                }
            }
        }

        // if there are error, save the message in session and redirect to the form
        if (count($message) > 0) {
            // save messages
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-add'));
            exit();
        }

        // create entry
        $newCategory = new Category;
        // put a value on each property
        $newCategory->setName($name);
        $newCategory->setDescription($description);
        $newCategory->setPicture($picture);
        $newCategory->setStatus($status);

        // insert entry
        $success = $newCategory->insert();

        // we need the router to redirect
        global $router;
        // to the list in case of success
        // to the form in case of failure
        if ($success) {
            $message['success'] = 'La catégorie a été ajoutée avec succés.';
            $redirect = $router->generate('backoffice-category-list');
        } else {
            $message['failure'] = 'Une erreur est survenue lors de l\'ajout de la catégorie. Merci d\'essayer ultérieurement.';
            $redirect = $router->generate('backoffice-category-add');
        }

        // save message in session
        if (count($message) > 0) {
            $_SESSION['sessionMessages'] = $message;
        }

        header("Location: " . $redirect);
        exit();
    }
}