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

function validSwitch($switch) {
    // if the switch is flipped, return true
    if(isset($switch)){
        return true;
    }
    // otherwise return false
    return false;
}

function validAddress($address)
{
    if($address != ""){
        return $address;
    }
    else {
        return !empty($address);
    }

}

function validCity($city)
{
    if($city == ""){
        return empty($city);
    }

}

function validState($state)
{
    if($state == ""){
        return empty($state);
    }

}

function validZip($zip)
{
    if($zip == ""){
        return empty($zip);
    }

}

function validCountry($country, $check)
{
    if($country == ""){
        return empty($country);
    }
    if($check == true){
        return !empty($country);
    }

}

// This function checks to see that a phone number is valid
function validPhone($phoneNum)
{
    if ($phoneNum == "") {
        // REMOVED ! BEFORE EMPTY FOR TEST PURPOSES!! PLEASE ADD BACK IN WHEN DONE TESTING
        return empty($phoneNum);
    } else if (ctype_digit($phoneNum)) {
        return $phoneNum;
    }
    return $phoneNum;
}