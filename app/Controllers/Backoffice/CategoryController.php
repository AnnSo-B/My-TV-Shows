<?php

namespace App\Controllers\Backoffice;

use App\Controllers\Backoffice\BackofficeController;
use App\Models\Category;


class CategoryController extends BackofficeController
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
        $this->show(
            'backoffice',
            'category/list',
            [
                'headTitle' => 'Liste des catégories - Backoffice',
                'list' => $categoryList
            ]
        );
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
        $this->show(
            'backoffice',
            'category/form',
            [
                'headTitle' => 'Ajout d\'une catégorie - Backoffice'
            ]
        );
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
        // we need the router to redirect
        global $router;

        // get the category we want to update
        $category = CATEGORY::find($id);

        // message and redirection if category doesn't exists 
        if (!$category) {
            $message['failure'] = 'La catégorie que vous souhaitez modifier n\'existe pas.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-list'));
            exit();
        }
    
        // for now we only display the form to test the route
        // we display the form
        // we'll use the same to add and update a category - conditional template
        $this->show(
            'backoffice',
            'category/form',
            [
                'elem' => $category,
                'headTitle' => 'Modification d\'une catégorie - Backoffice'
            ]
        );
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

        // message and redirection if category doesn't exists (a user has deleted the category while the current user is trying to update it for exemple)
        if (!$currentCategory) {
            $message['failure'] = 'La catégorie que vous souhaitez modifier n\'existe plus.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-list'));
            exit();
        }

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
        $this->show(
            'backoffice',
            'category/form',
            [
                'elem' => $category,
                "delete" => true,
                'headTitle' => 'Suppression d\'une catégorie - Backoffice'
            ]
        );
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
            $message['failure'] = 'La catégorie que vous souhaitez supprimer n\'existe plus.';

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

    /**
     * Method to display the category selection page
     *
     * @return void
     */
    public function selection()
    {

        // We extract the list of cateogries from the DB
        $categoryList = Category::findAll();      
        
        // we display the view and the list is sent
        $this->show(
            'backoffice',
            'category/selection',
            [
                'headTitle' => 'Sélection des catégories - Backoffice',
                'list' => $categoryList
            ]
        );
    }

    /**
     * Method to save the category selection in DB
     *
     * @return void
     */
    public function selectionPost()
    {
        // we need an array that'll contain messages
        $message = [];

        // data validation
        // https://www.php.net/manual/fr/function.filter-input-array.php
        // https://www.php.net/manual/fr/filter.filters.sanitize.php
        // if the table does not contain only integers between 1 and 5
        if (!(filter_input_array(INPUT_POST, ['home_order' => FILTER_VALIDATE_INT]))) {
            // send a message
            $message['array-error'] = 'Le formulaire ne retourne pas les informations attendues. Merci de vérifier votre sélection.';
        }

        // we save the received data
        $selection = $_POST['home_order'];

        // save user data in session to display them in case of redirection to the form
        $_SESSION['formData']['homeCategorySelection'] = $selection;

        // check that the 5 selections are ok
        if (in_array("", $selection)) {
            // send a message
            $message['selection-error'] = 'Merci de selectionner les 5 catégories';
        }

        // check an entry has only been selected once
        // https://www.php.net/manual/fr/function.array-unique.php
        $arrayUnique = array_unique($selection, SORT_NUMERIC);
        // if the array without duplicate values is smaller than the array received from form
        if (count($arrayUnique) < count($selection)) {
            // it means that at least one category has been selected several times
            // so we send a message
            $message['duplicate-value-error'] = 'Au moins une catégorie a été sélectionnée plusieurs fois.';
        }
        
        // we need the router to redirect
        global $router;

        // if there are error, save the message in session and redirect to the form
        if (count($message) > 0) {
            // save messages
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-category-selection'));
            exit();
        }

        // in order to change the categories' homepage order, we need to :
        // reset home_order of all categories to 0 in DB
        $categoryList = Category::findAll();
        foreach ($categoryList as $category) {
            $category->setHomeOrder(0);
            $category->update();
        }

        // set the new home_order to every impacted category in DB
        // we init the value of the home order
        $homeOrder = 1;
        // for each category reveived in POST
        foreach ($selection as $categoryId) {
            // we get the object
            $currentCategory = Category::find($categoryId);
            // we update its order
            $currentCategory->setHomeOrder($homeOrder);
            // we update the current category
            $success = $currentCategory->update();
            // we increment the home order for the next loop
            $homeOrder++;
        }

        // we send a message of success or failure and redirect to selection page
        if ($success) {
            $message['success'] = 'L\'ordre des catégories de la page d\'accueil a été mis à jour avec succès.';
        } else {
            $message['failure'] = 'Une erreur est survenue lors de la modification de l\'ordre des catégories. Merci d\'essayer ultérieurement.';
        }

        // save message in session
        if (count($message) > 0) {
            $_SESSION['sessionMessages'] = $message;
        }

        header("Location: " . $router->generate('backoffice-category-selection'));
        exit();



    }
}