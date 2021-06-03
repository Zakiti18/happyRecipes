<?php

/**
 * Class Admin
 * happyRecipes/classes/admin.php
 * Cesar Escalona and Phillip Ball
 * 05/30/2021
 *
 * Used to build admin (user) objects during a session.
 */
class Admin extends User
{
    // fields
    private $_isAdmin;

    // methods
    /**
     * Admin constructor.
     *
     * @param $_isAdmin boolean whether the user is an admin or not
     * @param $_fName String users first name
     * @param $_lName String users last name
     * @param $_username mixed users login username
     * @param $_password mixed users login password
     * @param $_email mixed users email
     */
    public function __construct($_isAdmin, $_fName, $_lName, $_username, $_password, $_email)
    {
        parent::__construct($_fName, $_lName, $_username, $_password, $_email);
        $this->_isAdmin = $_isAdmin;
    }

    /**
     * Returns whether or not this user is an admin
     *
     * @return boolean $_adminId
     */
    public function isAdmin()
    {
        return $this->_isAdmin;
    }
}