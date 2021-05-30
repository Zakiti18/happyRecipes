<?php

/**
 * Class recipe
 * happyRecipes/classes/recipe.php
 * Cesar Escalona and Phillip Ball
 * 05/30/2021
 *
 * Used to build a recipe object for use during a session.
 */
class Category
{
    // fields
    private $_name;
    private $_description;
    private $_avgCalCount;
    private $_typicalTime;

    // methods
    /**
     * Category constructor. Constructs a Category object.
     *
     * @param $_name String name of the category
     * @param $_description String description of the category
     * @param $_avgCalCount int average calorie count for recipes from this category
     * @param $_typicalTime double typical time recipes from this category are eaten
     */
    public function __construct($_name, $_description, $_avgCalCount, $_typicalTime)
    {
        $this->_name = $_name;
        $this->_description = $_description;
        $this->_avgCalCount = $_avgCalCount;
        $this->_typicalTime = $_typicalTime;
    }

    /**
     * The name of the category.
     *
     * @return String $_name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * The description for the category.
     *
     * @return String $_description
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * The average calorie count for eating a recipe from this category.
     *
     * @return int $_avgCalCount
     */
    public function getAvgCalCount()
    {
        return $this->_avgCalCount;
    }

    /**
     * The typical time recipes from this category are eaten.
     *
     * @return double $_typicalTime
     */
    public function getTypicalTime()
    {
        return $this->_typicalTime;
    }
}