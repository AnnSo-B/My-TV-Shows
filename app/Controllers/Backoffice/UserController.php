<?php

namespace App\Controllers\Backoffice;

use App\Controllers\Backoffice\BackofficeController;
use App\Models\User;

class UserController extends BackofficeController 
{
  /************************************************************************\
  |                Methods imposed by abstract CoreModel                   |
  \************************************************************************/

  /**
   * Method to display the series list page
   *
   * @return void
   */
  public function list()
  {
    // we extract the list of users from DB
    $userList = User::findAll();

    // we display the view
    $this->show(
      'backoffice',
      'user/list',
      [
        'headTitle' => 'Liste des utilisateurs - Backoffice',
        'list' => $userList
      ]
    );
  }

  /**
   * user can be added via the signup form
   */
  public function add() {}
  public function addPost() {}

  /**
   * Method to display the update form
   * 
   * @param int category Id
   * @return void
   */
  public function update($id) 
  {
    // we extract the user
    $user = USER::find($id);

    //we need the router to redirect
    global $router;

    // message and redirection if the user doesn't exist
    if (!$user) {
      $message['failure'] = 'L\'utilisateur que vous souhaitez modifier n\'existe pas.';

      // sage message in session
      $_SESSION['sessionMessages'] = $message;

      // redirect
      header("Location: " . $router->generate('backoffice-user-list'));
      exit();
    }

    // we display the form
    $this->show(
      'backoffice',
      'user/form',
      [
        'headTitle' => 'Modification d\'un utilisateur - Backoffice',
        'elem' => $user
      ]
    );
  }


  public function updatePost() {}
  public function delete($id) {}
  public function deletePost() {}
}