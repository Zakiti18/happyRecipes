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

// Categories route
$f3->route('GET /categories', function(){
    // Display the categories page
    $view = new Template();
    echo $view->render('views/categories.html');
});

// Weekly recipes sign up route
$f3->route('GET /form', function(){
    // Display the form for people to sign up for weekly recipes
    $view = new Template();
    echo $view->render('views/form.html');
});

// Run Fat-Free
$f3->run();