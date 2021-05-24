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

// Instantiate Fat-Fre and our controller
$f3 = Base::instance();
$con = new Controller($f3);

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

// Run Fat-Free
$f3->run();