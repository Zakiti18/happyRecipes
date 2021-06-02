<?php

/*
 * happyRecipes/index.php
 * Cesar Escalona and Phillip Ball
 * 04/30/2021
 *
 * Uses methods from controller to reroute the user
*/

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload file
require_once ('vendor/autoload.php');

// Start a session
session_start();

// Instantiate Fat-Free, our controller and access to the database
$f3 = Base::instance();
$con = new Controller($f3);
$dataLayer = new DataLayer();

// Define default route
$f3->route('GET /', function(){
    $GLOBALS["con"]->home();
});

// form related routes

// Weekly recipes sign up route
$f3->route('GET|POST /form', function(){
    $GLOBALS["con"]->form();
});

// Weekly recipes sign up route
$f3->route('GET /formSummary', function(){
    $GLOBALS["con"]->summary();
});

// category related routes

// Categories route
$f3->route('GET /categories', function(){
    $GLOBALS["con"]->categories();
});

// Breakfast route
$f3->route('GET /breakfast', function(){
    $GLOBALS["con"]->breakfast();
});

// Lunch route
$f3->route('GET /lunch', function(){
    $GLOBALS["con"]->lunch();
});

// Dinner route
$f3->route('GET /dinner', function(){
    $GLOBALS["con"]->dinner();
});

// account related routes

// signup route
$f3->route('GET|POST /signup', function(){
    $GLOBALS["con"]->signup();
});

// login route
$f3->route('GET|POST /login', function(){
    $GLOBALS["con"]->login();
});

// Run Fat-Free
$f3->run();