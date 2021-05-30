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
    private $_adminId;

    // methods
    /**
     * The admins id value in the database
     *
     * @return int $_adminId
     */
    public function getAdminId()
    {
        return $this->_adminId;
    }
}