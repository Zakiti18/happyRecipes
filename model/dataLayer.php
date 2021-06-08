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

    // saves an order to the database
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

    function getUser($username){
        // 1. Define the query
        $sql = "SELECT * FROM hr_users WHERE user_name = :uName";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':uName', $username, PDO::PARAM_STR);

        // 4. Execute the query
        // if the user does not exist return false
        if(!$statement->execute()){
            return false;
        }

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

        // return the user object
        return $user;
    }

    function getRecipe($recipe_name)
    {
        // 1. Define the query
        $sql = "SELECT * FROM hr_recipes WHERE recipe_name = :rName";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':rName', $recipe_name, PDO::PARAM_STR);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results (build the recipe)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $row){
            $recipe_name = $row['recipe_name'];
            $recipe_description = $row['recipe_description'];
            $recipe_image = $row['recipe_image'];
            $recipe_code = $row['recipe_code'];
            $userId = $row['userId'];
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
                    array_push($ingredients, $this->getIngredient($decipher[$i]) . $this->getIngredient($decipher[$i + 1]));
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

        // changes the userId to the name associated with said id
        $userId = $this->getUserId($userId);

        // Saving this to an object
        return new Recipe($recipe_name, $recipe_description, $recipe_image, $ingredients, $userId);
    }

    function getIngredient($ingredientId)
    {
        // 1. Define the query
        $sql = "SELECT * FROM hr_ingredients WHERE ingredient_id = :iId";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':iId', $ingredientId, PDO::PARAM_STR);

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

    function getUserId($userId)
    {
        // 1. Define the query
        $sql = "SELECT * FROM hr_users WHERE userId = :uId";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':uId', $userId, PDO::PARAM_STR);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        // we want to return both the first name and the last name so, we access the
        // associative array at index 0 of the outer array and get firstName and lastName
        // from that inner associative array
        return $result[0]['firstName'] . " " . $result[0]['lastName'];
    }
}