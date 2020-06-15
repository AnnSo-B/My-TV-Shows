<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class User extends CoreModel {


    /************************************************************************\
    |                           Properties                                   |
    \************************************************************************/
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;



    /************************************************************************\
    |                           Getters and Setters                          |
    \************************************************************************/

    /**
     * Get the value of email
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    /************************************************************************\
    |                Methods imposed by abstract CoreModel                   |
    \************************************************************************/
    static public function findAll() {}
    static public function find($id) {}
    public function insert() {}
    public function update() {}
    public function delete() {}
}
