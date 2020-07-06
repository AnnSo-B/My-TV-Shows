<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Series extends CoreModel {


    /************************************************************************\
    |                           Properties                                   |
    \************************************************************************/
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $synopsis;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $release_year;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $category_id;
    
    /**
     * @var string
     */
    private $category_name;



    /************************************************************************\
    |                           Getters and Setters                          |
    \************************************************************************/

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of synopsis
     *
     * @return  string
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Set the value of synopsis
     *
     * @param  string  $synopsis
     *
     * @return  self
     */ 
    public function setSynopsis(string $synopsis)
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     *
     * @return  self
     */ 
    public function setPicture(string $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of release_year
     *
     * @return  int
     */ 
    public function getReleaseYear()
    {
        return $this->release_year;
    }

    /**
     * Set the value of release_year
     *
     * @param  int  $release_year
     *
     * @return  self
     */ 
    public function setReleaseYear(int $release_year)
    {
        $this->release_year = $release_year;

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
     * Get the value of category_id
     *
     * @return  int
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     *
     * @return  self
     */ 
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }

    /**
     * Get the value of category_name
     *
     * @return  string
     */ 
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * Set the value of category_name
     *
     * @param  string  $category_name
     *
     * @return  self
     */ 
    public function setCategoryName(string $category_name)
    {
        $this->category_name = $category_name;

        return $this;
    }



    /************************************************************************\
    |                              Methods                                   |
    \************************************************************************/

    /**
     * Method to extract all series from DB with associated category
     * 
     * @return Series[]
     */
    static public function findAll()
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = 'SELECT `series`.*, `category`.`name` AS `category_name`
            FROM `series`
            INNER JOIN `category`
            ON `series`.`category_id` = `category`.`id`';

        // execute the request
        $pdoStatement = $pdo->query($sql);

        // prepare the results
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // return it
        return $results;
    }

    /**
     * Method to find a series according to its id
     *
     * @param [int] $id
     * @return Series
     */
    static public function find($id)
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = 'SELECT `series`.*, `category`.`name` AS `category_name` 
            FROM `series` 
            INNER JOIN `category`
            ON `series`.`category_id` = `category`.`id`
            WHERE `series`.`id` =' . $id;

        // execute the request
        $pdoStatement = $pdo->query($sql);

        // prepare the results
        $results = $pdoStatement->fetchObject(self::class);

        // return the results
        return $results;
    }

    /**
     * Method to extract the 5 latest series
     * 
     * @return Series[]
     */
    static public function findLatestSeries()
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = 'SELECT *
            FROM `series`
            ORDER BY `created_at` DESC
            LIMIT 5';

        // execute the request
        $pdoStatement = $pdo->query($sql);

        // prepare the results
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);

        // return it
        return $results;
    }

    /**
     * Method to insert a new series in DB
     * 
     * @return bool indicates the success or failure of the insertion
     */
    public function insert()
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = "INSERT INTO `series`
            (`title`, `synopsis`, `picture`, `release_year`, `status`, `category_id`)
            VALUES (:title, :synopsis, :picture, :release_year, :status, :category_id)";

        // prepare the request
        $pdoStatement = $pdo->prepare($sql);

        // execute the request
        $success = $pdoStatement->execute([
            ':title' => $this->title,
            ':synopsis' => $this->synopsis,
            ':picture' => $this->picture,
            ':release_year' => $this->release_year,
            ':status' => $this->status,
            ':category_id' => $this->category_id
        ]);

        // check the insertion
        if ($success) {
            $this->id = $pdo->lastInsertId();
        }

        return $success;
    }

    /**
     * Method to update a series in DB
     * 
     * @return bool indicates the success or failure of the insertion
     */
    public function update()
    {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = "UPDATE `series`
            SET `title` = :title, 
                `synopsis` = :synopsis, 
                `picture` = :picture, 
                `release_year` = :release_year, 
                `status` = :status, 
                `category_id` = :category_id, 
                `updated_at` = NOW()
            WHERE `id` = :id
        ";

        // prepare the request
        $pdoStatement = $pdo->prepare($sql);

        // execute the request
        $success = $pdoStatement->execute([
            ':title' => $this->title,
            ':synopsis' => $this->synopsis,
            ':picture' => $this->picture,
            ':release_year' => $this->release_year,
            ':status' => $this->status,
            ':category_id' => $this->category_id,
            ':id' => $this->id
        ]);

        // check the update
        return $success;
    }

    /**
     * Method to delete a series
     */
    public function delete() {
        // log into DB
        $pdo = Database::getPDO();

        // write the request
        $sql = "DELETE
            FROM `series`
            WHERE `id` = :id
        ";

        // prepare the request
        $pdoStatement = $pdo->prepare($sql);

        // execute the request
        $success = $pdoStatement->execute([
            ':id' => $this->id
        ]);

        // check the update
        return $success;
    }
}