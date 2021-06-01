<?php

/**
 * Class User
 * happyRecipes/classes/user.php
 * Cesar Escalona and Phillip Ball
 * 05/30/2021
 *
 * Used to build user objects during a session.
*/
class User
{
    // fields
    private $_userId;
    private $_fName;
    private $_lName;
    private $_username;
    private $_password;
    private $_email;

    // methods
    /**
     * User constructor. constructs a user object.
     *
     * @param $_fName String users first name
     * @param $_lName String users last name
     * @param $_username mixed users login username
     * @param $_password mixed users login password
     * @param $_email mixed users email
     */
    public function __construct($_fName, $_lName, $_username, $_password, $_email)
    {
        $this->_fName = $_fName;
        $this->_lName = $_lName;
        $this->_username = $_username;
        $this->_password = $_password;
        $this->_email = $_email;
    }

    /**
     * The users id value in the database
     *
     * @return int $_userId
     */
    public function getUserId()
    {
        return $this->_userId;
    }

    /**
     * The users first name
     *
     * @return String $_fName
     */
    public function getFName()
    {
        return $this->_fName;
    }

    /**
     * The users last name
     *
     * @return String $_lName
     */
    public function getLName()
    {
        return $this->_lName;
    }

    /**
     * The users login username
     *
     * @return mixed $_username
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * The users login password
     *
     * @return mixed $_password
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * The users email
     *
     * @return mixed $_email
     */
    public function getEmail()
    {
        return $this->_email;
    }
}