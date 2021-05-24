<?php

/**
 * happyRecipes/model/validation.php
 * Cesar Escalona and Phillip Ball
 * 05/24/2021
 *
 * This file will contain all validation functions for happyRecipes site.
 */
class Validation
{
    /**
     * This function checks to see that a string is all alphabetic.
     * @param $name - The name being validated.
     * @return bool - Whether the name is valid or not.
     */
    static function validName($name)
    {
        if ($name == "") {
            return !empty($name);
        } else if (ctype_alpha($name)) {
            return $name;
        }
    }

    /**
     * This function checks to see that an email address is valid
     * @param $email - The email being validated.
     * @return bool - Whether the email is valid or not.
     */
    static function validEmail($email)
    {
        $symbol = "/@/i";
        $pattern = "/.com/i";
        if ($email == "") {
            return !empty($email);
        } else if (preg_match($symbol, $email)) {
            if (preg_match($pattern, $email)) {
                return $email;
            }
        }
    }

    // This function checks to see if the user clicked the recipes by mail switch
    static function validSwitch($switch)
    {
        // if the switch is flipped, return true
        if (isset($switch)) {
            return true;
        }
        // otherwise return false
        return false;
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
}