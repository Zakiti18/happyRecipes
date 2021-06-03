<?php

/**
 * happyRecipes/controller/controller.php
 * Cesar Escalona and Phillip Ball
 * 05/24/2021
 *
 * This is our controller for the happyRecipes project.
 */
class Controller
{
    // router (variable that will store our Fat-Free stuff)
    private $_f3;

    /**
     * Controller constructor.
     * @param $f3 - Our instance of Fat-Free.
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    // default route

    /**
     * Displays the home page.
     */
    function home()
    {
        // Displays the home page
        $view = new Template();
        echo $view->render('views/home.html');
    }

    // form related routes

    /**
     * Displays a form page for the user to sign up for weekly recipes.
     */
    function form()
    {
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
            if (Validation::validName($userFName)) {
                $_SESSION['fname'] = $userFName;
            } else {
                $this->_f3->set('errors["fName"]', 'Please enter a valid first name');
            }

            // Last Name
            $userLName = $_POST['lname'];
            if (Validation::validName($userLName)) {
                $_SESSION['lname'] = $userLName;
            } else {
                $this->_f3->set('errors["lName"]', 'Please enter a valid last name');
            }

            // Email
            $userEmail = $_POST['email'];
            if (Validation::validEmail($userEmail)) {
                $_SESSION['email'] = $userEmail;
            } else {
                $this->_f3->set('errors["Email"]', 'Please enter a valid email that contains "@" and "."');
            }

            // Phone number
            $userPhone = $_POST['phoneNum'];
            if (Validation::validPhone($userPhone)) {
                $_SESSION['phoneNum'] = $userPhone;
            } else {
                $this->_f3->set('errors["PhoneNum"]', 'Please enter a valid phone number with dashes E.g. 253-123-4567');
            }

            // Save the users switch choice
            $userSwitch = $_POST['switch'];
            if(isset($userSwitch)){
                $_SESSION['switch'] = true;
            }

            // Address
            $userAddress = $_POST['address'];
            if(isset($userSwitch)) {
                if (Validation::validAddress($userAddress)) {
                    $_SESSION['address'] = $userAddress;
                } else {
                    $this->_f3->set('errors["Address"]', 'Please enter a valid Address');
                }
            } else {
                $_SESSION['address'] = $userAddress;
            }

            // City
            $userCity = $_POST['city'];
            if(isset($userSwitch)) {
                if (Validation::validCity($userCity)) {
                    $_SESSION['city'] = $userCity;

                } else {
                    $this->_f3->set('errors["City"]', 'Please enter a valid City');
                }
            } else {
                $_SESSION['City'] = $userCity;
            }

            // State
            $userState = $_POST['state'];
            if(isset($userSwitch)) {
                if (Validation::validState($userState)) {
                    $_SESSION['state'] = $userState;

                } else {
                    $this->_f3->set('errors["State"]', 'Please enter a valid State');
                }
            } else {
                $_SESSION['State'] = $userState;
            }

            // Zip
            $userZip = $_POST['zip'];
            if(isset($userSwitch)) {
                if (Validation::validZip($userZip)) {
                    $_SESSION['zip'] = $userZip;

                } else {
                    $this->_f3->set('errors["Zip"]', 'Please enter a valid Zip Code');
                }
            } else {
                $_SESSION['Zip'] = $userZip;
            }

            // Country
            $userCountry = $_POST['country'];
            if(isset($userSwitch)) {
                if (Validation::validCountry($userCountry)) {
                    $_SESSION['country'] = $userCountry;

                } else {
                    $this->_f3->set('errors["Country"]', 'Please enter a valid Country');
                }
            } else {
                $_SESSION['Country'] = $userCountry;
            }

            $_SESSION['fCat'] = $_POST['fCat'];
            $_SESSION['pref'] = $_POST['pref'];

            //If the error array is empty, redirect to summary page
            if (empty($this->_f3->get('errors'))) {
                // Redirect
                header('location: formSummary');
            }
        } // End of validation if form is submitted

        // Add the data to the hive
        $this->_f3->set('userFName', $userFName);
        $this->_f3->set('userLName', $userLName);
        $this->_f3->set('Email', $userEmail);
        $this->_f3->set('phoneNum', $userPhone);
        $this->_f3->set('Switch', $userSwitch);
        $this->_f3->set('Address', $userAddress);
        $this->_f3->set('City', $userCity);
        $this->_f3->set('State', $userState);
        $this->_f3->set('Zip', $userZip);
        $this->_f3->set('Country', $userCountry);

        // Display the form for people to sign up for weekly recipes
        $view = new Template();
        echo $view->render('views/form.html');
    }

    /**
     * Displays the summary of user input from the form.
     */
    function summary()
    {
        // Display the summary of the form for people signing up for weekly recipes
        $view = new Template();
        echo $view->render('views/formSummary.html');
    }

    // categories related routes

    /**
     * Displays a page where the user can select a category of recipes.
     */
    function categories()
    {
        // Display the categories page
        $view = new Template();
        echo $view->render('views/categories.html');
    }

    /**
     * Displays recipes in the breakfast category
     */
    function breakfast()
    {
        // Display a specific category page
        $view = new Template();
        echo $view->render('views/breakfast.html');
    }

    /**
     * Displays recipes in the lunch category
     */
    function lunch()
    {
        // Display a specific category page
        $view = new Template();
        echo $view->render('views/lunch.html');
    }

    /**
     * Displays recipes in the dinner category
     */
    function dinner()
    {
        // Display a specific category page
        $view = new Template();
        echo $view->render('views/dinner.html');
    }

    /**
     * Displays a form page for making a user on the website
     */
    function signup()
    {
        // Reinitialize the session array
        $_SESSION = array();

        // initialize all variables to store user input
        $fName = "";
        $lName = "";
        $username = "";
        $email = "";

        // If the form has been submitted, add the data to session and send the user to the next page
        // otherwise send them to signup page.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // First Name
            $fName = $_POST['fname'];
            if (!Validation::validName($fName)) {
                $this->_f3->set('errors["fName"]', 'Please enter a valid first name');
            }

            // Last Name
            $lName = $_POST['lname'];
            if (!Validation::validName($lName)) {
                $this->_f3->set('errors["lName"]', 'Please enter a valid last name');
            }

            // Username
            $username = $_POST['username'];
            if(!Validation::validNewUsername($username)) {
                $this->_f3->set('errors["username"]', 'Usernames must be 3 or more characters and not already in use');
            }

            // Password
            $password = $_POST['password'];
            if(!Validation::validNewPassword($password)){
                $this->_f3->set('errors["password"]', 'Passwords must be at least 8 characters long');
            }

            // Email
            $email = $_POST['email'];
            if (!Validation::validEmail($email)) {
                $this->_f3->set('errors["email"]', 'Please enter a valid email that contains "@" and "."');
            }

            //If the error array is empty, create the new user and redirect to home page
            if (empty($this->_f3->get('errors'))) {
                // creates a new user using the user input
                $newUser = new User($fName, $lName, $username, $password, $email);
                $_SESSION['user'] = $GLOBALS['dataLayer']->newUser($newUser);

                // Redirect
                header('location: home');
            }
        } // End of validation if form is submitted

        // Add the data to the hive
        $this->_f3->set('fName', $fName);
        $this->_f3->set('lName', $lName);
        $this->_f3->set('email', $email);
        $this->_f3->set('username', $username);

        // Display the signup page
        $view = new Template();
        echo $view->render('views/signup.html');
    }

    /**
     * Displays a form page for logging into a user on the website
     */
    function login()
    {
        // Reinitialize the session array
        $_SESSION = array();

        // initialize username for stickiness
        $username = "";

        // If the form has been submitted, add the data to session and send the user to the next page
        // otherwise send them to login page.
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Username
            $username = $_POST['username'];
            if(!Validation::validUsername($username)) {
                $this->_f3->set('errors["username"]', 'Incorrect username');
            }

            // Password
            $password = $_POST['password'];
            if(!Validation::validPassword($username, $password)){
                $this->_f3->set('errors["password"]', 'Incorrect password');
            }

            //If the error array is empty, add the user to the session and redirect to home page
            if (empty($this->_f3->get('errors'))) {
                // adds the user to the session
                $_SESSION['user'] = $GLOBALS['dataLayer']->getUser($username);

                // Redirect
                header('location: home');
            }
        } // End of validation if form is submitted

        // Add the data to the hive
        $this->_f3->set('username', $username);

        // Display the login page
        $view = new Template();
        echo $view->render('views/login.html');
    }

    /**
     * Logs the current user out and redirects them to the home page.
     */
    function logout(){
        session_start();
        session_destroy();
        $_SESSION = array();
        header('location: home');
    }

    /**
     * Displays a profile page that changes whether the user is an admin or not.
     * Admins have the ability to add, remove and edit database related things.
     * Non-admins have the ability to favorite and un-favorite recipes.
     */
    function profile()
    {
        $user = $_SESSION['user'];

        if($user instanceof Admin){
            // ability to add, remove and edit database related things go here
        }
        else{
            // ability to favorite and un-favorite recipes go here
        }

        // Display the profile page
        $view = new Template();
        echo $view->render('views/profile.html');
    }
}