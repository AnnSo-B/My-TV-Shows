<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {


    /************************************************************************\
    |                           Properties                                   |
    \************************************************************************/
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;
    /**
     * @var int
     */
    private $status;



    /************************************************************************\
    |                           Getters and Setters                          |
    \************************************************************************/
    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return  self
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;

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


    /************************************************************************\
    |                              Methods                                   |
    \************************************************************************/

    /**
     * Method to extract all categories from DB
     * 
     * @return Category[]
     */
    static public function findAll()
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = 'SELECT * FROM `category`';

        // execute the request
        $pdoStatement = $pdo->query($sql);

        // prepare the results
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // return it
        return $results;
    }

    /**
     * Method to find a category acording to its id
     */
    static public function find($id)
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = 'SELECT * 
        FROM `category` 
        WHERE `id` =' . $id;

        // execute the request
        $pdoStatement = $pdo->query($sql);

        // prepare the results
        $results = $pdoStatement->fetchObject(self::class);

        // return the results
        return $results;
    }

    /**
     * Method to insert a new category in DB
     * 
     * @return bool indicates the success or failure of the insertion
     */
    public function insert()
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = "INSERT INTO `category`
            (`name`, `description`, `picture`, `status`)
            VALUES (:name, :description, :picture, :status)";

        // prepare the request
        $pdoStatement = $pdo->prepare($sql);

        // execute the request
        $success = $pdoStatement->execute([
            ':name' => $this->name,
            ':description' => $this->description,
            ':picture' => $this->picture,
            ':status' => $this->status
        ]);

        // check the insertion
        if ($success) {
            $this->id = $pdo->lastInsertId();
        }
        return $success;
    }
}