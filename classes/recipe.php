<?php

/**
 * Class recipe
 * happyRecipes/classes/recipe.php
 * Cesar Escalona and Phillip Ball
 * 05/30/2021
 *
 * Used to build a recipe object for use during a session.
 */
class Recipe
{
    // fields
    private $_recipe_id;
    private $_name;
    private $_description;
    private $_recipeImage;
    private $_ingredients;
    private $_submittedBy;
    private $_cook_time;
    private $_feeds;
    private $_category;


    // methods
    /**
     * Recipe constructor. Constructs a Recipe object.
     *
     * @param $_name String the name of the recipe
     * @param $_description String the description of the recipe
     * @param $_recipeImage String the name of the image
     * @param $_ingredients String[] the ingredients in the recipe
     * @param $_submittedBy String who submitted the recipe
     */
    public function __construct($_name, $_description, $_recipeImage, $_ingredients, $_submittedBy)
    {
        $this->_name = $_name;
        $this->_description = $_description;
        $this->_recipeImage = $_recipeImage;
        $this->_ingredients = $_ingredients;
        $this->_submittedBy = $_submittedBy;
    }

    /**
     * The recipe id
     *
     * @return int the recipes id in the database
     */
    public function getRecipeId()
    {
        return $this->_recipe_id;
    }

    /**
     * Sets the recipe id (should never reset the id in the database)
     *
     * @param int $recipe_id the recipes id in the database
     */
    public function setRecipeId($recipe_id)
    {
        $this->_recipe_id = $recipe_id;
    }

    /**
     * The recipes name
     *
     * @return String $_name
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * The recipes description
     *
     * @return String $_description
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * The recipes image in the database
     *
     * @return String The recipes image name in the database
     */
    public function getRecipeImage()
    {
        return $this->_recipeImage;
    }

    /**
     * The recipes ingredients in the database
     *
     * @return String[] $_ingredients
     */
    public function getIngredients()
    {
        return $this->_ingredients;
    }

    /**
     * Who the recipe was submitted by
     *
     * @return String $_submittedBy
     */
    public function getSubmittedBy()
    {
        return $this->_submittedBy;
    }

    /**
     * Get the time required to cook
     *
     * @return mixed
     */
    public function getCookTime()
    {
        return $this->_cook_time;
    }

    /**
     * @param mixed $cook_time
     */
    public function setCookTime($cook_time): void
    {
        $this->_cook_time = $cook_time;
    }

    /**
     * @return mixed
     */
    public function getFeeds()
    {
        return $this->_feeds;
    }

    /**
     * @param mixed $feeds
     */
    public function setFeeds($feeds): void
    {
        $this->_feeds = $feeds;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->_category = $category;
    }
}