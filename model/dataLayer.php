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
}