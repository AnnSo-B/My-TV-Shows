<?php

namespace App\Controllers\Backoffice;

use App\Controllers\Backoffice\BackofficeController;
use App\Models\Category;
use App\Models\Series;


class SeriesController extends BackofficeController
{

    /**
     * Method to display the series list page
     *
     * @return void
     */
    public function list()
    {

        // We extract the list of series from the DB
        $seriesList = Series::findAll();      
        
        // we display the view and the list is sent
        $this->show(
            'backoffice',
            'series/list',
            [
                'headTitle' => 'Liste des séries - Backoffice',
                'list' => $seriesList
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
        // we need the category list for the selection
        $categoryList = Category::findAll();

        // we display the form
        // we'll use the same to add and update a series - conditional template
        $this->show(
            'backoffice',
            'series/form',
            [
                'headTitle' => 'Ajout d\'une série - Backoffice',
                'categoryList' => $categoryList
            ]
        );
    }

    /**
     * Method to add a new series in DB
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
            if (array_key_exists('title', $_POST)) {
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($title) > 64) {
                    $message['title_failure'] = 'Le titre de la série ne peut excéder 64 caractères.';                
                }
                else if (strlen($title) < 1) {
                    $message['title_failure'] = 'Merci d\'indiquer le titre de la série.';                
                }
            }
            if (array_key_exists('synopsis', $_POST)) {
                $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (array_key_exists('picture', $_POST)) {
                $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($picture) > 128) {
                    $message['picture_failure'] = 'La description d\'un produit ne peut excéder 128 caractères.';
                }
            }
            if (array_key_exists('release_year', $_POST)) {
                $releaseYear = filter_input(INPUT_POST, 'release_year', FILTER_VALIDATE_INT, [1900, 2100]);
                if (!$releaseYear) {
                    $message['release_year_failure'] = 'Cette année de diffusion n\'est pas valide.';
                }
            }
            if (array_key_exists('status', $_POST)) {
                $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT, [1, 2]);
                if (!$status) {
                    $message['status_failure'] = 'Ce statut n\'est pas valide.';
                }
            }
            if (array_key_exists('series_category', $_POST)) {
                $seriesCategory = filter_input(INPUT_POST, 'series_category', FILTER_VALIDATE_INT, [1]);
                // TODO : improvement : if the category Id doesn't exist, send an error message
                if (!$seriesCategory) {
                    $message['series_category_failure'] = 'Cette catégorie n\'est pas valide.';
                }
            }
        }

        // save user data in session to display them in case of redirection to the form
        $_SESSION['formData']['title'] = $title;
        $_SESSION['formData']['synopsis'] = $synopsis;
        $_SESSION['formData']['picture'] = $picture;
        $_SESSION['formData']['releaseYear'] = $releaseYear;
        $_SESSION['formData']['status'] = $status;
        $_SESSION['formData']['seriesCategory'] = $seriesCategory;

        // if there are errors, save the message in session and redirect to the form
        if (count($message) > 0) {
            // save messages
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-series-add'));
            exit();
        }

        // create entry
        $newSeries = new Series;
        // put a value on each property
        $newSeries->setTitle($title);
        $newSeries->setSynopsis($synopsis);
        $newSeries->setPicture($picture);
        $newSeries->setReleaseYear($releaseYear);
        $newSeries->setStatus($status);
        $newSeries->setCategoryId($seriesCategory);

        // insert entry
        $success = $newSeries->save();

        // we need the router to redirect
        global $router;
        // to the list in case of success
        // to the form in case of failure
        if ($success) {
            $message['success'] = 'La série a été ajoutée avec succés.';
            $redirect = $router->generate('backoffice-series-list');
        } else {
            $message['failure'] = 'Une erreur est survenue lors de l\'ajout de la série. Merci d\'essayer ultérieurement.';
            $redirect = $router->generate('backoffice-series-add');
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
     * @param int series Id
     * @return void
     */
    public function update($id)
    {
        // get the series we want to update
        $series = Series::find($id);

        // we need the router to redirect
        global $router;

        // message and redirection if series doesn't exist
        if (!$series) {
            $message['failure'] = 'La série que vous souhaitez modifier n\'existe pas.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-series-list'));
            exit();
        }

        // we need the category list for the selection
        $categoryList = Category::findAll();
    
        // we display the form
        // we'll use the same to add and update a series - conditional template
        $this->show(
            'backoffice',
            'series/form',
            [
                'headTitle' => 'Modification d\'une série - Backoffice',
                'series' => $series,
                'categoryList' => $categoryList
            ]
        );
    }

    /**
     * Method to update a series in DB
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
            if (array_key_exists('title', $_POST)) {
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($title) > 64) {
                    $message['title_failure'] = 'Le titre de la série ne peut excéder 64 caractères.';                
                }
                else if (strlen($title) < 1) {
                    $message['title_failure'] = 'Merci d\'indiquer le titre de la série.';                
                }
            }
            if (array_key_exists('synopsis', $_POST)) {
                $synopsis = filter_input(INPUT_POST, 'synopsis', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            if (array_key_exists('picture', $_POST)) {
                $picture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
                // https://www.php.net/manual/fr/function.strlen.php
                if (strlen($picture) > 128) {
                    $message['picture_failure'] = 'La description d\'un produit ne peut excéder 128 caractères.';
                }
            }
            if (array_key_exists('release_year', $_POST)) {
                $releaseYear = filter_input(INPUT_POST, 'release_year', FILTER_VALIDATE_INT, [1900, 2100]);
                if (!$releaseYear) {
                    $message['release_year_failure'] = 'Cette année de diffusion n\'est pas valide.';
                }
            }
            if (array_key_exists('status', $_POST)) {
                $status = filter_input(INPUT_POST, 'status', FILTER_VALIDATE_INT, [1, 2]);
                if (!$status) {
                    $message['status_failure'] = 'Ce statut n\'est pas valide.';
                }
            }
            if (array_key_exists('series_category', $_POST)) {
                $seriesCategory = filter_input(INPUT_POST, 'series_category', FILTER_VALIDATE_INT, [1]);
                // TODO : improvement : if the category Id doesn't exist, send an error message
                if (!$seriesCategory) {
                    $message['series_category_failure'] = 'Cette catégorie n\'est pas valide.';
                }
            }
        }

        // save user data in session to display them in case of redirection to the form
        $_SESSION['formData']['id'] = $id;
        $_SESSION['formData']['title'] = $title;
        $_SESSION['formData']['synopsis'] = $synopsis;
        $_SESSION['formData']['picture'] = $picture;
        $_SESSION['formData']['releaseYear'] = $releaseYear;
        $_SESSION['formData']['status'] = $status;
        $_SESSION['formData']['seriesCategory'] = $seriesCategory;

        // if there are error, save the message in session and redirect to the form
        if (count($message) > 0) {
            // save messages
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-series-update', ['id' => $id]));
            exit();
        }

        // update entry
        // find the entry
        $currentSeries = Series::find($id);

        // message and redirection if series doesn't exists (a user has deleted the series while the current user is trying to update it for exemple)
        if (!$currentSeries) {
            $message['failure'] = 'La série que vous souhaitez modifier n\'existe plus.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-series-list'));
            exit();
        }

        // put a value on each property
        $currentSeries->setTitle($title);
        $currentSeries->setSynopsis($synopsis);
        $currentSeries->setPicture($picture);
        $currentSeries->setReleaseYear($releaseYear);
        $currentSeries->setStatus($status);
        $currentSeries->setCategoryId($seriesCategory);

        // insert entry
        $success = $currentSeries->save();

        // we need the router to redirect
        global $router;
        // to the list in case of success
        // to the form in case of failure
        if ($success) {
            $message['success'] = 'La série a été modifiée avec succés.';
            $redirect = $router->generate('backoffice-series-list');
        } else {
            $message['failure'] = 'Une erreur est survenue lors de la modification de la série. Merci d\'essayer ultérieurement.';
            $redirect = $router->generate('backoffice-series-update', ['id' => $id]);
        }

        // save message in session
        if (count($message) > 0) {
            $_SESSION['sessionMessages'] = $message;
        }

        header("Location: " . $redirect);
        exit();
    } 

    /**
     * Method to display the series the user wants to delete
     * 
     * @param int series Id
     * @return void
     */
    public function delete($id)
    {
        // get the series we want to update
        $series = Series::find($id);
        
        // we need the router to redirect
        global $router;

        // message and redirection if series doesn't exists
        if (!$series) {
            $message['failure'] = 'La série que vous souhaitez supprimer n\'existe pas.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-series-list'));
            exit();
        }

        // we need the category list for the selection
        $categoryList = Category::findAll();
    
        // we display the form
        // we'll use the same to add and update a series - conditional template
        $this->show(
            'backoffice',
            'series/form',
            [
                'headTitle' => 'Suppression d\'une catégorie - Backoffice',
                'series' => $series,
                "delete" => true,
                'categoryList' => $categoryList
            ]
        );
    }

    /**
     * Method to delete a series
     * 
     * @param int series Id
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

        // we need the series
        $series = Series::find($id);

        // message and redirection if series doesn't exists (a user has already deleted the series the current user wants to delete for exemple)
        if (!$series) {
            $message['failure'] = 'La série que vous souhaitez supprimer n\'existe plus.';

            // save message in session
            $_SESSION['sessionMessages'] = $message;

            // redirect
            header("Location: " . $router->generate('backoffice-series-list'));
            exit();
        }

        //delete series
        $success = $series->delete();
    
        // to the list in case of success either way but we have to create message
        if ($success) {
            $message['success'] = 'La série a été supprimée.';
        } else {
            $message['failure'] = 'La série n\'a pu être supprimée. Merci de réessayer ultérieurement';
        }
    
        // save message in session
        if (count($message) > 0) {
            $_SESSION['sessionMessages'] = $message;
        }

        // we need the router to redirect
        global $router;
        // redirect to the list of series
        header("Location: " . $router->generate('backoffice-series-list'));
        exit();
    }
}