const searchBox = document.getElementById('searchBox');
let inputTimer;
    

searchBox.addEventListener("input", () => {
    let textVal = searchBox.value;

    clearTimeout(inputTimer);

    inputTimer = setTimeout(function() {
        fetch('./Request/search.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ text: textVal})
        })
        .then(response => response.json())
        .then(data => console.log(data))
        .catch(error => console.error(error));
        console.log("User stopped typing", textVal);
    }, 500); 

});