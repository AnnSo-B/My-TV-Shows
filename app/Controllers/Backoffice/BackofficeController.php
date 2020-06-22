<?php

namespace App\Controllers\Backoffice;

use App\Controllers\CoreController;

abstract class BackofficeController extends CoreController 
{
    
  /************************************************************************\
  |                           Abstract Methods                             |
  \************************************************************************/

  abstract public function list();
  abstract public function add();
  abstract public function addPost();
  abstract public function update($id);
  abstract public function updatePost();
  abstract public function delete($id);
  abstract public function deletePost();
}
