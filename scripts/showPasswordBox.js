document.getElementById("passwordCheckbox").onclick = showOrHide;

// show or hide the password text depending on if the checkbox is checked or not
function showOrHide() {
    let checkType = document.getElementById("password");
    if (checkType.type === "password") {
        checkType.type = "text";
    } else {
        checkType.type = "password";
    }
}