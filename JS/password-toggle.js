passField = document.querySelector(".password-wrapper input[type='password']");
btnToggle = document.querySelector(".password-toggle");

btnToggle.onclick = () => {
    if (passField.type == "password") {
        passField.type = "text";
    } else {
        passField.type = "password";
    }
}
