const form = document.querySelector(".container form");
const btnSU = form.querySelector(".button button");

form.addEventListener("submit", (e) => {
    e.preventDefault();
});

btnSU.addEventListener("click", () => {
    let xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "signup.php", true);
    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState === XMLHttpRequest.DONE && xmlhttp.status === 200) {
            let data = xmlhttp.response;
            if (data == "success") {
                location.href = "user.php"; 
            }
        }
    };
    let formData = new FormData(form);
    xmlhttp.send(formData);
});