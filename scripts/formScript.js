/*
  This is the script file for the form.html page
  Authors: Phillip Ball, Cesar Escalona
  File: form_script.js
  Date: 06/01/2021
*/

document.getElementById("weekly").onsubmit = validate;

function validate()
{
    let Valid = true;

    //clear all error msgs
    let errors = document.getElementsByClassName("error")
    for (let i = 0; i < errors.length; i++) {
        errors[i].style.display = "none";
    }

    //check first name
    let fName = document.getElementById("fname").value;
    if (fName === "") {
        let errfName = document.getElementById("err-fname");
        errfName.style.display = "inline";
        Valid = false;
    }

    // check last name
    let lName = document.getElementById("lname").value;
    if (lName === "") {
        let errlName = document.getElementById("err-lname");
        errlName.style.display = "inline";
        Valid = false;
    }

    // Check email
    let Email = document.getElementById("email").value;
    if (Email === "") {
        let errEmail = document.getElementById("err-email");
        errEmail.style.display = "inline";
        Valid = false;
    }

    // Check phone number
    let Phone = document.getElementById("phoneNum").value;
    if (Phone === "") {
        let errPhone = document.getElementById("err-phone");
        errPhone.style.display = "inline";
        Valid = false;
    }
    console.log(Valid);
    return Valid;
}