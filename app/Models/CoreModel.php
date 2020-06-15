<?php

namespace App\Models;

class CoreModel {

    /************************************************************************\
    |                           Properties                                   |
    \************************************************************************/
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;


    /************************************************************************\
    |                           Getters and Setters                          |
    \************************************************************************/
    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        return $this->updated_at;
    }

    /************************************************************************\
    |                                 Methods                                |
    \************************************************************************/
    /**
     * Check if this entry has an id
     * 
     * @return bool true if the entry has an id
     */
    public function alreadyExists() 
    {
        return $this->id > 0;
    }

    /**
     * Method to save the entry
     */
    public function save()
    {
        // if the entry has an id it already exists
        if ($this->alreadyExists()) {
            // so we execute the update method
            return $this->update();
        } else {
            // otherwise we execute the insert method
            return $this->insert();

        }
    }    

}