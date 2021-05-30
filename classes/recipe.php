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
    private $_recipeId;
    private $_name;
    private $_description;
    private $_submittedBy;
    private $_ingredients;
    private $_steps;
    private $_nutritionFacts;
    private $_extraMessage;

    // methods
    /**
     * Recipe constructor. Constructs a Recipe object.
     *
     * @param $_recipeId int the recipes id in the database
     * @param $_name String the name of the recipe
     * @param $_description String the description of the recipe
     * @param $_submittedBy String who submitted the recipe
     * @param $_ingredients String[] the ingredients needed for the recipe
     * @param $_steps String[] the steps to take to make the recipe
     * @param $_nutritionFacts String[] the nutritional facts about the recipe
     * @param $_extraMessage String a message from the user that submitted this recipe
     */
    public function __construct($_recipeId, $_name, $_description, $_submittedBy,
                                $_ingredients, $_steps, $_nutritionFacts, $_extraMessage)
    {
        $this->_recipeId = $_recipeId;
        $this->_name = $_name;
        $this->_description = $_description;
        $this->_submittedBy = $_submittedBy;
        $this->_ingredients = $_ingredients;
        $this->_steps = $_steps;
        $this->_nutritionFacts = $_nutritionFacts;
        $this->_extraMessage = $_extraMessage;
    }

    /**
     * The recipes ID in the database
     *
     * @return int $_recipeId
     */
    public function getRecipeId()
    {
        return $this->_recipeId;
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

    /**
     * The ingredients needed to make the recipes
     *
     * @return String[] $_ingredients
     */
    public function getIngredients()
    {
        return $this->_ingredients;
    }

    /**
     * The step-by-step process of making the recipe
     *
     * @return String[] $_steps
     */
    public function getSteps()
    {
        return $this->_steps;
    }

    /**
     * The nutritional facts about the recipe
     *
     * @return String[] $_nutritionFacts
     */
    public function getNutritionFacts()
    {
        return $this->_nutritionFacts;
    }

    /**
     * An extra message from the user that submitted the recipe
     *
     * @return String $_extraMessage
     */
    public function getExtraMessage()
    {
        return $this->_extraMessage;
    }
}