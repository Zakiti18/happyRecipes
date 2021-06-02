/*
  This is the script file for the form.html page
  Authors: Phillip Ball, Cesar Escalona
  File: form_script.js
  Date: 06/02/2021
*/

document.getElementById("weekly").onsubmit = validate;

function validate()
{
    // initialize a flag variable to check the form validation
    let Valid = true;

    //clear all error msgs
    let errors = document.getElementsByClassName("err")
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

    // Check if checkbox is selected, if so, require rest of validation
    let checkBox = document.getElementById("switch");
    if(checkBox.checked === true) {

        // Check address
        let address = document.getElementById("address").value;
        if(address === ""){
            let errAddress = document.getElementById("err-address");
            errAddress.style.display = "inline";
            Valid = false;
        }

        // Check city
        let city = document.getElementById("city").value;
        if(city === ""){
            let errCity = document.getElementById("err-city");
            errCity.style.display = "inline";
            Valid = false;
        }

        // Check state
        let state = document.getElementById("state").value;
        if(state === ""){
            let errState = document.getElementById("err-state");
            errState.style.display = "inline";
            Valid = false;
        }

        // Check zip
        let zip = document.getElementById("zip").value;
        if(zip === ""){
            let errZip = document.getElementById("err-zip");
            errZip.style.display = "inline";
            Valid = false;
        }

        // Check country
        let country = document.getElementById("country").value;
        if(country === ""){
            let errCountry = document.getElementById("err-country");
            errCountry.style.display = "inline";
            Valid = false;
        }
    }

    // return if the form is valid or not
    return Valid;
}