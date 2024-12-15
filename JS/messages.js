const chatdiv = document.querySelector(".chat-box");
const uid = document.querySelector(".details .unique_id");
const outgoing = document.querySelector(".sending");
const incoming = document.querySelector(".receiving p");
const form = document.querySelector(".typing-area");
const textArea = document.querySelector(".typing-area input");
const sendBtn = document.querySelector(".typing-area button");

console.log('uid: ' +uid.innerText);

// console.log(outgoing);
form.addEventListener("submit", (e) => {
    e.preventDefault();
});



sendBtn.addEventListener("click", () => {

    const user_id = uid.innerText;
    const message = textArea.value.trim(); 

    

    if (message !== '') {
        const sendingdiv = document.createElement('div');
        sendingdiv.classList.add('chat', 'sending');
        chatdiv.appendChild(sendingdiv);

        const detsdiv = document.createElement('div');
        detsdiv.classList.add('details');
        sendingdiv.appendChild(detsdiv);

        const msgPara = document.createElement('p');
        msgPara.innerText = message;
        detsdiv.appendChild(msgPara);
        
        let removeSent = document.querySelector('.status');
        if (removeSent) {
            removeSent.remove();
        }

        const sent = document.createElement('div');
        sent.className  = 'status';
        sent.textContent = 'sending';
        chatdiv.appendChild(sent);

        chatdiv.scrollTop = chatdiv.scrollHeight;

        const requestData = {
            user_id: user_id,
            message: message
        };

        // console.log(requestData);

        const url = "insertMessage.php";

        fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(requestData)
        })
        .then((response) => {
            console.log(response);
            if (response.ok) {
                textArea.value = ''; 
            } else {
            throw new Error("Request failed.");
            }
        })
        .then((data) => {
            // console.log(data); // Log the response data
        })
        .catch((error) => {
            console.error(error); // Handle any errors
        });
    }
});