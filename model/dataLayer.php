<?php

/**
 * Class Datalayer
 * happyRecipes/model/dataLayer.php
 * Cesar Escalona and Phillip Ball
 * 06/01/2021
 *
 * This file will interact with the database for our happy recipes project.
 */
require_once ($_SERVER['DOCUMENT_ROOT'].'/../happyRecipesConfig.php');

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

        // 5. Process the results (get userId) (typically used for select statements)
        return $user->getUserId();
    }

    function getUser($username, $password){
        // 1. Define the query
        $sql = "SELECT * FROM hr_users WHERE user_name = :uName AND pass_word = :pWord";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameters
        $statement->bindParam(':uName', $username, PDO::PARAM_STR);
        $statement->bindParam(':pWord', $password, PDO::PARAM_STR);

        // 4. Execute the query
        $statement->execute();

        // 5. Process the results (typically used for select statements)
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $userId = $result['userId'];
        $fName = $result['firstName'];
        $lName = $result['lastName'];
        $userName = $result['userName'];
        $passWord = $result['passWord'];
        $email = $result['email'];

        // return the user as an object
        return new User($fName, $lName, $userName, $passWord, $email);
    }
}