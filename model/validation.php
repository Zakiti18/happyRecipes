<?php

/**
 * Class Validation
 * happyRecipes/model/validation.php
 * Cesar Escalona and Phillip Ball
 * 05/24/2021
 *
 * This file will contain all validation functions for happyRecipes site.
 */
class Validation
{
    //fields
    const USERNAME_MIN_LENGTH = 3;
    const PASSWORD_MIN_LENGTH = 8;

    // methods
    /**
     * This function checks to see that a string is all alphabetic, also trims off extra whitespace.
     * @param $name - The name being validated.
     * @return bool - Whether the name is valid or not.
     */
    static function validName($name)
    {
        return ctype_alpha(trim($name));
    }

    /**
     * This function checks to see that an email address is valid
     * @param $email - The email being validated.
     * @return bool - Whether the email is valid or not.
     */
    static function validEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * This function checks to see if an address is required based on the switch
     * @param $address - The address being validated.
     * @return bool - Whether the address is valid or not.
     */
    static function validAddress($address)
    {
        if ($address != "") {
            return $address;
        } else {
            return !empty($address);
        }
    }

    /**
     * This function checks to see if a city is required based on the switch
     * @param $city - The city being validated.
     * @return bool - Whether the city is valid or not.
     */
    static function validCity($city)
    {
        if ($city != "") {
            return $city;
        } else {
            return !empty($city);
        }
    }

    /**
     * This function checks to see if a state is required based on the switch
     * @param $state - The state being validated.
     * @return bool - Whether the state is valid or not.
     */
    static function validState($state)
    {
        if ($state != "") {
            return $state;
        } else {
            return !empty($state);
        }
    }

    /**
     * This function checks to see if a zip code is required based on the switch
     * @param $zip - The zipcode being validated.
     * @return bool - Whether the zipcode is valid or not.
     */
    static function validZip($zip)
    {
        if ($zip != "") {
            return $zip;
        } else {
            return !empty($zip);
        }
    }

    /**
     * This function checks to see if a country is required based on the switch
     * @param $country - The country being validated.
     * @return bool - Whether the country is valid or not.
     */
    static function validCountry($country)
    {
        if ($country != "") {
            return $country;
        } else {
            return !empty($country);
        }
    }

    /**
     * This function checks to see that a phone number is valid
     * @param $phoneNum - The phone number being validated.
     * @return bool - Whether the phone number is valid or not.
     */
    static function validPhone($phoneNum)
    {
        if ($phoneNum == "") {
            return !empty($phoneNum);
        } else if (ctype_digit($phoneNum)) {
            return $phoneNum;
        }
        return $phoneNum;
    }

    /**
     * Returns true if the username is valid
     * (not already taken(in use) and 3+ characters long), false otherwise.
     *
     * @param $username String The username being validated
     * @return boolean true if the username does not already exist
     * and is at least 3 characters long, false otherwise
     */
    static function validNewUsername($username){
        if(strlen($username) < self::USERNAME_MIN_LENGTH){
            return false;
        }
        $compare = $GLOBALS['dataLayer']->getUser($username);
        if($compare == false){
            return false;
        }
        if($username == $compare->getUsername()){
            return false;
        }
        return true;
    }

    /**
     * Returns true if the password is valid (PASSWORD_MIN_LENGTH+ characters long), false otherwise.
     *
     * @param $password mixed The password to be validated
     * @return boolean true if the password is equal to or greater
     * than PASSWORD_MIN_LENGTH, false otherwise
     */
    static function validNewPassword($password){
        return strlen($password) >= self::PASSWORD_MIN_LENGTH;
    }

    static function validUsername($username)
    {
        return $GLOBALS['dataLayer']->getUser($username) != false;
    }

    /**
     * Returns true if the entered password matches the password of the user with the given username,
     * false otherwise.
     *
     * @param $username String The username of the attempted login (needed to get user from database)
     * @param $password mixed The password to be validated
     * @return boolean true if the entered password is equal
     * to the user password with the same username
     */
    static function validPassword($username, $password)
    {
        $compare = $GLOBALS['dataLayer']->getUser($username);
        return $password == $compare->getPassword();
    }
}