<?php

// This file will contain all validation functions for happyRecipes site

// This function checks to see that a string is all alphabetic
function validName($name)
{
    if ($name == "") {
        return !empty($name);
    } else if (ctype_alpha($name)) {
        return $name;
    }
}

// This function checks to see that an email address is valid
function validEmail($email)
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
function validSwitch($switch)
{
    // if the switch is flipped, return true
    if(isset($switch)){
        return true;
    }
    // otherwise return false
    return false;
}

// This function checks to see if an address is required based on the switch
function validAddress($address)
{
    if($address != ""){
        return $address;
    }
    else {
        return !empty($address);
    }
}

// This function checks to see if a city is required based on the switch
function validCity($city)
{
    if($city != ""){
        return $city;
    } else {
        return !empty($city);
    }
}

// This function checks to see if a state is required based on the switch
function validState($state)
{
    if($state != ""){
        return $state;
    } else {
        return !empty($state);
    }
}

// This function checks to see if a zip code is required based on the switch
function validZip($zip)
{
    if($zip != ""){
        return $zip;
    } else {
        return !empty($zip);
    }
}

// This function checks to see if a country is required based on the switch
function validCountry($country)
{
    if($country != ""){
        return $country;
    } else {
        return !empty($country);
    }
}

// This function checks to see that a phone number is valid
function validPhone($phoneNum)
{
    if ($phoneNum == "") {
        return !empty($phoneNum);
    } else if (ctype_digit($phoneNum)) {
        return $phoneNum;
    }
    return $phoneNum;
}