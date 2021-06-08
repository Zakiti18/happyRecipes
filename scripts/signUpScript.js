/*
  This is the script file for the signup.html page
  Authors: Phillip Ball, Cesar Escalona
  File: signUpScript.js
  Date: 06/08/2021
*/

document.getElementById("signup").onsubmit = validate;

function validate()
{
    // initialize a flag variable to check the form validation
    let Validated = true;

    //clear all error msgs
    let errors = document.getElementsByClassName("err")
    for (let i = 0; i < errors.length; i++) {
        errors[i].style.display = "none";
    }

    //check first name
    let firstName = document.getElementById("fname").value;
    if (firstName === "") {
        let errFirstName = document.getElementById("err-fname");
        errFirstName.style.display = "inline";
        Validated = false;
    }

    //check password
    let passWord = document.getElementById("password").value;
    if (passWord  === "") {
        let errPass = document.getElementById("err-password");
        errPass.style.display = "inline";
        Validated = false;
    }

    // check last name
    let lName = document.getElementById("lname").value;
    if (lName === "") {
        let errLastName = document.getElementById("err-lname");
        errLastName.style.display = "inline";
        Validated = false;
    }

    //check User name
    let userName = document.getElementById("username").value;
    if (userName === "") {
        let errUserName = document.getElementById("err-username");
        errUserName.style.display = "inline";
        Validated = false;
    }

    // Check email
    let Email = document.getElementById("email").value;
    if (Email === "") {
        let errEmail = document.getElementById("err-email");
        errEmail.style.display = "inline";
        Validated = false;
    }

// return if the form is valid or not
return Validated;
}