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

        // we need an array that'll contain messages
        $message = [];

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

        // save user data in session to display them in case of redirection to the form
        $_SESSION['formData']['name'] = $name;
        $_SESSION['formData']['description'] = $description;
        $_SESSION['formData']['picture'] = $picture;
        $_SESSION['formData']['status'] = $status;

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
        $success = $newCategory->save();

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

    /**
     * Method to display the update form
     * 
     * @param int category Id
     * @return void
     */
    public function update($id)
    {
        // get the category we want to update
        $category = CATEGORY::find($id);

        // TODO --> redirection if category doesn't exists
    
        // for now we only display the form to test the route
        // we display the form
        // we'll use the same to add and update a category - conditional template
        $this->show('backoffice', 'category/form', ['elem' => $category]);
    }

    /**
     * Method to update a category in DB
     * 
     * @return void
     */
    public function updatePost()
    {

        // we need the router to redirect
        global $router;

        // we need an array that'll contain messages
        $message = [];

        // data validation
        // https://www.php.net/manual/fr/filter.filters.sanitize.php
        if (isset($_POST)) {
            if (array_key_exists('id', $_POST)) {
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            }
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

        // save user data in session to display them in case of redirection to the form
        $_SESSION['formData']['id'] = $id;
        $_SESSION['formData']['name'] = $name;
        $_SESSION['formData']['description'] = $description;
        $_SESSION['formData']['picture'] = $picture;
        $_SESSION['formData']['status'] = $status;

        // if there are error, save the message in session and redirect to the form
        if (count($message) > 0) {
            // save messages
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-update', ['id' => $id]));
            exit();
        }

        // update entry
        // find the entry
        $currentCategory = Category::find($id);
        // put a value on each property
        $currentCategory->setName($name);
        $currentCategory->setDescription($description);
        $currentCategory->setPicture($picture);
        $currentCategory->setStatus($status);

        // insert entry
        $success = $currentCategory->save();

        // we need the router to redirect
        global $router;
        // to the list in case of success
        // to the form in case of failure
        if ($success) {
            $message['success'] = 'La catégorie a été modifiée avec succés.';
            $redirect = $router->generate('backoffice-category-list');
        } else {
            $message['failure'] = 'Une erreur est survenue lors de la modification de la catégorie. Merci d\'essayer ultérieurement.';
            $redirect = $router->generate('backoffice-category-update', ['id' => $id]);
        }

        // save message in session
        if (count($message) > 0) {
            $_SESSION['sessionMessages'] = $message;
        }

        header("Location: " . $redirect);
        exit();
    } 

    /**
     * Method to display the category the user wants to delete
     * 
     * @param int category Id
     * @return void
     */
    public function delete($id)
    {
        // we need the router to redirect
        global $router;

        // get the category we want to update
        $category = CATEGORY::find($id);

        // message and redirection if category doesn't exists
        if (!$category) {
            $message['failure'] = 'La catégorie que vous souhaitez supprimer n\'existe pas.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-list'));
            exit();
        }
    
        // for now we only display the form to test the route
        // we display the form
        // we'll use the same to add and update a category - conditional template
        $this->show('backoffice', 'category/form', ['elem' => $category, "delete" => true]);
    }

    /**
     * Method to delete a category
     * 
     * @param int category Id
     * @return void
     */
    public function deletePost()
    {
        
        // we need the router to redirect
        global $router;

        // data validation
        // https://www.php.net/manual/fr/filter.filters.sanitize.php
        if (isset($_POST)) {
            if (array_key_exists('id', $_POST)) {
                $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            }
        }    

        // we need the category
        $category = Category::find($id);

        // message and redirection if category doesn't exists (a user has already deleted the cataegory the current user wants to delete for exemple)
        if (!$category) {
            $message['failure'] = 'La catégorie que vous souhaitez supprimer n\'existe pas.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-list'));
            exit();
        }

        //delete category
        $success = $category->delete();
    
        // to the list in case of success either way but we have to create message
        if ($success) {
            $message['success'] = 'La catégorie a été supprimée.';
        } else {
            $message['failure'] = 'La catégorie n\'a pu être supprimée. Merci de réessayer ultérieurement';
        }
    
        // save message in session
        if (count($message) > 0) {
            $_SESSION['sessionMessages'] = $message;
        }

        // we need the router to redirect
        global $router;
        // redirect to the list of category
        header("Location: " . $router->generate('backoffice-category-list'));
        exit();
    }
}