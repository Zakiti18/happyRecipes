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
    private $_name;
    private $_description;
    private $_recipeImage;
    private $_ingredients;
    private $_submittedBy;

    // methods
    /**
     * Recipe constructor. Constructs a Recipe object.
     *
     * @param $_recipeId int the recipes id in the database
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
     * Who the recipe was submitted by
     *
     * @return String $_submittedBy
     */
    public function getSubmittedBy()
    {
        return $this->_submittedBy;
    }

}