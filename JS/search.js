const searchBox = document.getElementById('searchBox');
const resultDiv = document.querySelector('.searchResult');
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
        .then(data => {
            // console.log(data.users)
            if (data.success) {
                resultDiv.innerHTML = '';

                for(let user of data.users) {
                    console.log(user);
                    const resultUser = document.createElement('div');
                    const userIMG = document.createElement('img');
                    userIMG.src = `../User-content/pfp/${user.img}`;

                    resultUser.className = 'searchUser';
                    // resultUser.textContent = `${user.firstname } ${user.lastname}`;
                    resultUser.onclick = () => {
                        window.location.href = `../chat.php?uid=${user.user_id}`;
                    };
                    
                    resultUser.appendChild(userIMG);
                    resultUser.innerHTML += `<p>${user.firstname } ${user.lastname}</p>`;
                    resultDiv.appendChild(resultUser);
                    resultDiv.style.display = 'block';
                } 
            } else {
                resultDiv.style.display = 'none';
            }

        })
        .catch(error => console.error(error));
        console.log("User stopped typing", textVal);
    }, 500); 

});