<?php

// happyRecipes/index.php
// Cesar Escalona and Phillip Ball
// 04/30/2021
// This is our controller for the happyRecipes project

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once ('vendor/autoload.php');
require_once('model/validation.php');

// Start a session
session_start();

// Instantiate Fat-Fre
$f3 = Base::instance();

// Define default route
$f3->route('GET /', function(){
    // Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

// Weekly recipes sign up route
$f3->route('GET|POST /form', function($f3){
    // Reinitialize the session array
    $_SESSION = array();

    // initialize all variables to store user input
    $userFName = "";
    $userLName = "";
    $userEmail = "";
    $userSwitch = "";
    $userAddress = "";
    $userCity = "";
    $userState = "";
    $userZip = "";
    $userCountry = "";
    $userPhone = "";

    // If the form has been submitted, add the data to session
    // and send the user to the next page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // First Name
        $userFName = $_POST['fname'];
        if (validName($userFName)) {
            $_SESSION['fname'] = $userFName;
        } else {
            $f3->set('errors["fName"]', 'Please enter a valid first name');
        }

        // Last Name
        $userLName = $_POST['lname'];
        if (validName($userLName)) {
            $_SESSION['lname'] = $userLName;
        } else {
            $f3->set('errors["lName"]', 'Please enter a valid last name');
        }

        // Email
        $userEmail = $_POST['email'];
        if (validEmail($userEmail)) {
            $_SESSION['email'] = $userEmail;
        } else {
            $f3->set('errors["Email"]', 'Please enter a valid email that contains "@" and ".com"');
        }

        // Phone number
        $userPhone = $_POST['phoneNum'];
        if (validPhone($userPhone)) {
            $_SESSION['phoneNum'] = $userPhone;
        } else {
            $f3->set('errors["PhoneNum"]', 'Please enter a valid phone number with dashes E.g. 253-123-4567');
        }

        // Save the users switch choice
        $userSwitch = $_POST['switch'];
        if(isset($userSwitch)){
            $_SESSION['switch'] = true;
        }

        // Address
        $userAddress = $_POST['address'];
        if(isset($userSwitch)) {
            if (validAddress($userAddress)) {
                $_SESSION['address'] = $userAddress;
            } else {
                $f3->set('errors["Address"]', 'Please enter a valid Address');
            }
        } else {
            $_SESSION['address'] = $userAddress;
        }

        // City
        $userCity = $_POST['city'];
        if(isset($userSwitch)) {
            if (validCity($userCity)) {
                $_SESSION['city'] = $userCity;

            } else {
                $f3->set('errors["City"]', 'Please enter a valid City');
            }
        } else {
            $_SESSION['City'] = $userCity;
        }

        // State
        $userState = $_POST['state'];
        if(isset($userSwitch)) {
            if (validState($userState)) {
                $_SESSION['state'] = $userState;

            } else {
                $f3->set('errors["State"]', 'Please enter a valid State');
            }
        } else {
            $_SESSION['State'] = $userState;
        }

        // Zip
        $userZip = $_POST['zip'];
        if(isset($userSwitch)) {
            if (validZip($userZip)) {
                $_SESSION['zip'] = $userZip;

            } else {
                $f3->set('errors["Zip"]', 'Please enter a valid Zip Code');
            }
        } else {
            $_SESSION['Zip'] = $userZip;
        }

        // Country
        $userCountry = $_POST['country'];
        if(isset($userSwitch)) {
            if (validCountry($userCountry)) {
                $_SESSION['country'] = $userCountry;

            } else {
                $f3->set('errors["Country"]', 'Please enter a valid Country');
            }
        } else {
            $_SESSION['Country'] = $userCountry;
        }

        $_SESSION['fCat'] = $_POST['fCat'];
        $_SESSION['pref'] = $_POST['pref'];

        //If the error array is empty, redirect to summary page
        if (empty($f3->get('errors'))) {
            // Redirect
            header('location: formSummary');
        }
    } // End of validation if form is submitted

    // Add the data to the hive
    $f3->set('userFName', $userFName);
    $f3->set('userLName', $userLName);
    $f3->set('Email', $userEmail);
    $f3->set('phoneNum', $userPhone);
    $f3->set('Switch', $userSwitch);
    $f3->set('Address', $userAddress);
    $f3->set('City', $userCity);
    $f3->set('State', $userState);
    $f3->set('Zip', $userZip);
    $f3->set('Country', $userCountry);

    // Display the form for people to sign up for weekly recipes
    $view = new Template();
    echo $view->render('views/form.html');
});

// Weekly recipes sign up route
$f3->route('GET /formSummary', function(){
    // Display the summary of the form for people signing up for weekly recipes
    $view = new Template();
    echo $view->render('views/formSummary.html');
});

// Categories route
$f3->route('GET /categories', function(){
    // Display the categories page
    $view = new Template();
    echo $view->render('views/categories.html');
});

// Specific category routes

// Breakfast route
$f3->route('GET /breakfast', function(){
    // Display a specific category page
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

// Lunch route
$f3->route('GET /lunch', function(){
    // Display a specific category page
    $view = new Template();
    echo $view->render('views/lunch.html');
});

// dinner route
$f3->route('GET /dinner', function(){
    // Display a specific category page
    $view = new Template();
    echo $view->render('views/dinner.html');
});

// Run Fat-Free
$f3->run();