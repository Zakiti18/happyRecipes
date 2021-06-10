<?php

// require database access
require_once ($_SERVER['DOCUMENT_ROOT'].'/../happyRecipesConfig.php');

/**
 * Class Datalayer
 * happyRecipes/model/dataLayer.php
 * Cesar Escalona and Phillip Ball
 * 06/01/2021
 *
 * This file will interact with the database for our happy recipes project.
 */
class DataLayer
{
    // add a field for the database object
    private $_dbh;

    // define a constructor
    function __construct()
    {
        // connect to the database
        try{
            // instantiate a PDO database object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            //echo "Connected"; // for debugging
        }
        catch (PDOException $e){
            //echo $e->getMessage(); // for debugging
            die("ERROR! Please call to place your order.");
        }
    }

    /**
     * Saves a new user to the database using the information from the sign up page.
     *
     * @param $user Object a user object
     */
    function newUser($user)
    {
        // 1. Define the query
        $sql = "INSERT INTO hr_users (firstName, lastName, user_name, pass_word, email)
                VALUES (:fName, :lName, :uName, :pWord, :email)";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':fName', $user->getFName(), PDO::PARAM_STR);
        $statement->bindParam(':lName', $user->getLName(), PDO::PARAM_STR);
        $statement->bindParam(':uName', $user->getUsername(), PDO::PARAM_STR);
        $statement->bindParam(':pWord', $user->getPassword(), PDO::PARAM_STR);
        $statement->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);

        // 4. Execute the query
        $statement->execute();
    }

    /**
     * Retrieves information from the database based on a username
     * and builds a user object with said information.
     *
     * @param $username String a users username
     * @return User an object with all of the user's account information
     */
    function getUser($username){
        // 1. Define the query
        // when no information is entered, get all users (used by admin)
        if(empty($username)){
            $sql = "SELECT * FROM hr_users";
        }
        else{
            $sql = "SELECT * FROM hr_users WHERE user_name = :uName";
        }

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':uName', $username, PDO::PARAM_STR);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results (build the user)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // grab the individual parts
        // the [0] is there because for some reason storing what fetchAll returns
        // into another variable (result in this case) stores an array in an array
        // so we need to access the array in the array that is at the 0th index
        // this was we'll call it "fun" to figure out
        $isAdmin = $result[0]['isAdmin'];
        $userId = $result[0]['userId'];
        $fName = $result[0]['firstName'];
        $lName = $result[0]['lastName'];
        $userName = $result[0]['user_name'];
        $passWord = $result[0]['pass_word'];
        $email = $result[0]['email'];

        // build the user object
        if($isAdmin != null){
            $user = new Admin(true, $fName, $lName, $userName, $passWord, $email);
        }
        else{
            $user = new User($fName, $lName, $userName, $passWord, $email);
        }
        $user->setUserId($userId);
        $user->setFavorites($this->getAllFavorites($user));

        // return the user object
        // when no information is entered, get all users (used by admin)
        if(empty($username)){
            return $result;
        }
        else{
            return $user;
        }
    }

    /**
     * Searches through the database for a recipe that shares the given recipe name
     * and builds a Recipe object using the information from the database.
     *
     * @param $recipe_info String the name of a recipe
     * @return Recipe a Recipe object with information from the database
     */
    function getRecipe($recipe_info)
    {
        // 1. Define the query
        // allows search by name and/or id
        if(!is_numeric($recipe_info)){
            $sql = "SELECT * FROM hr_recipes, hr_users
                WHERE hr_recipes.userId = hr_users.userId
                AND hr_recipes.recipe_name = :rInfo";
        }
        else{
            $sql = "SELECT * FROM hr_recipes, hr_users
                WHERE hr_recipes.userId = hr_users.userId
                AND hr_recipes.recipe_id = :rInfo";
        }

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':rInfo', $recipe_info, PDO::PARAM_STR);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results (build the recipe)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            $recipe_id = $row['recipe_id'];
            $recipe_name = $row['recipe_name'];
            $recipe_description = $row['recipe_description'];
            $recipe_image = $row['recipe_image'];
            $recipe_code = $row['recipe_code'];
            $userName = $row['firstName'] . " " . $row['lastName'];
        }

        // we need to decipher the recipe_code into the ingredients
        // first we split the code into an array of chars
        $decipher = str_split($recipe_code);
        // this is the array that will hold the ingredients to be used in the Recipe constructor
        $ingredients = array();
        // then loop over the decipher array by looping until we've looped over each char
        for($i = 0; $i < strlen($recipe_code); $i++){
            // if we are currently looking at " " (space) move on to the next index
            // otherwise we know we're looking at a number
            if($decipher[$i] != " "){
                // so, we need to check if that number is a double digit
                // by checking the index next to us
                if($decipher[$i + 1] != " "){
                    // if the next index is a number we know we're looking at a double digit
                    // so we concatenate both the current index and the next
                    array_push($ingredients, $this->getIngredient($decipher[$i] . $decipher[$i + 1]));
                    // and increment the loop an extra time because we just used two indexes rather than one
                    $i++;
                    // if the last two indexes make up a double digit then that extra increment will
                    // give us a null pointer exception, so we need to break.
                    if($i >= strlen($recipe_code)){
                        break;
                    }
                }
                // if the index next to the one we're currently looking at is not a number
                // we know that we're on a single digit
                else{
                    array_push($ingredients, $this->getIngredient($decipher[$i]));
                }
            }
        }

        // Saving this to an object
        $recipe = new Recipe($recipe_name, $recipe_description, $recipe_image, $ingredients, $userName);
        $recipe->setRecipeId($recipe_id);
        return $recipe;
    }

    /**
     * Retrieves an ingredient from the database based on the id of said ingredient.
     *
     * @param $ingredientId int the id of an ingredient
     * @return String the ingredient
     */
    function getIngredient($ingredientId)
    {
        // 1. Define the query
        $sql = "SELECT * FROM hr_ingredients WHERE ingredient_id = :iId";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':iId', $ingredientId, PDO::PARAM_INT);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // $result is an array of arrays but we know that we should only receive one row
        // from the query, so we know the array we access is at index 0 of the outer array
        // so we access the ingredient_name in the inner array by first accessing the inner array itself
        // with the [0]
        return $result[0]['ingredient_name'];
    }

    /**
     * Adds the recipe id of the recipe to the end of the users current
     * favorite recipes list.
     *
     * @param $user User The user we're adding the recipe to as a favorite
     * @param $recipe Recipe The recipe that we'll get the id of
     * @return string
     */
    function addToFavorites($user, $recipe)
    {
        // concatenate the new favorite recipes id to the end of the users current
        // favorites list, also adds a space before the id in case the id is a double digit
        $updatedFavorites = $this->getFavoritesCode($user) . " " . $recipe->getRecipeId();
        $userId = $user->getUserId();

        // 1. Define the query
        $sql = "UPDATE hr_users SET favorites_code = '$updatedFavorites' WHERE userId = '$userId'";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 4. Execute the query
        if($statement->execute()){
            return "Added!";
        }
        return "Error adding.";
    }

    /**
     * Deciphers the users favorite_code and converts it into an array
     * of recipe objects.
     *
     * @param $user User The user we're getting the favorites of
     * @return array The array of recipe objects
     */
    function getAllFavorites($user)
    {
        // gets the favorite_code and turns it into an array
        $code = str_split($this->getFavoritesCode($user));
        // initialize the array that will be returned
        $favorites = array();

        // loop through the code
        for($i = 0; $i < sizeof($code); $i++){
            // skip spaces
            if($code[$i] != " "){
                // if two digits are not separated by a space, its a double digit number
                if($code[$i + 1] != " "){
                    // push a recipe object that's made using the id
                    array_push($favorites, $this->getRecipe($code[$i] . $code[$i + 1]));
                    $i++;

                    // if the last id is a double digit, avoid null pointer
                    if($i >= sizeof($code)){
                        break;
                    }
                }
                // push a recipe object that's made using the id
                else{
                    array_push($favorites, $this->getRecipe($code[$i]));
                }
            }
        }

        return $favorites;
    }

    /**
     * Returns the frankeincode that Phillip made up, can be converted into recipes based on id.
     *
     * @param $user - User The user we're getting the favorite code from
     * @return int The favorite_code of the user
     */
    function getFavoritesCode($user)
    {
        // 1. Define the query
        $sql = "SELECT * FROM hr_users WHERE userId = :uId";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':uId', $user->getUserId(), PDO::PARAM_INT);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result[0]['favorites_code'];
    }
}