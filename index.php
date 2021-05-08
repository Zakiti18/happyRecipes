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
$f3->route('GET|POST /form', function(){
    // If the form has been submitted, add the data to session
    // and send the user to the next page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_SESSION['fname'] = $_POST['fname'];
        $_SESSION['lname'] = $_POST['lname'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['zip'] = $_POST['zip'];
        $_SESSION['country'] = $_POST['country'];
        $_SESSION['phoneNum'] = $_POST['phoneNum'];
        $_SESSION['fCat'] = $_POST['fCat'];
        $_SESSION['pref'] = $_POST['pref'];
        header('location: formSummary');
    }

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