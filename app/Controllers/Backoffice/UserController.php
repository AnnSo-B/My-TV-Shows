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

  public function add() {}
  public function addPost() {}
  public function update($id) {}
  public function updatePost() {}
  public function delete($id) {}
  public function deletePost() {}
}