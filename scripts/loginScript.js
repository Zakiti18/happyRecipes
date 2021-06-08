/*
  This is the script file for the login.html page
  Authors: Phillip Ball, Cesar Escalona
  File: loginScript.js
  Date: 06/08/2021
*/

document.getElementById("login").onsubmit = validate;

function validate()
{
    // initialize a flag variable to check the form validation
    let Login = true;

    //clear all error msgs
    let errors = document.getElementsByClassName("err")
    for (let i = 0; i < errors.length; i++) {
        errors[i].style.display = "none";
    }

    //check User name
    let uName = document.getElementById("username").value;
    if (uName === "") {
        let errUserName = document.getElementById("err-username");
        errUserName.style.display = "inline";
        Login = false;
    }

    //check password
    let pWord = document.getElementById("password").value;
    if (pWord  === "") {
        let errPass = document.getElementById("err-password");
        errPass.style.display = "inline";
        Login = false;
    }

// return if the login is valid or not
    return Login;
}