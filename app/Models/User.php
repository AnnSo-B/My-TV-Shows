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
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $role_id;



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

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string  $lastname
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     *
     * @return  self
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of role_id
     *
     * @return  int
     */ 
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * Set the value of role_id
     *
     * @param  int  $role_id
     *
     * @return  self
     */ 
    public function setRoleId(int $role_id)
    {
        $this->role_id = $role_id;

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

    /************************************************************************\
    |                              Own Methods                               |
    \************************************************************************/

    /**
     * Method to get a user according to one email
     *
     * @param $email user send by the user
     * @return User
     */
    static public function findByEmail($email) {

        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = "SELECT * 
            FROM `user` 
            WHERE `email` = :email";

        // prepare the request
        $pdoStatement = $pdo->prepare($sql);

        // execute the request
        $pdoStatement->execute([
            ':email' => $email
        ]);

        // prepare the results
        $result = $pdoStatement->fetchObject(self::class);

        // return it
        return $result;
    }
}
