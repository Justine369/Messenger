const chatbox = document.querySelector(".chat-box");
const msgP = document.querySelector(".details p");

const session_id = document.querySelector(".session_user").innerText;
const user_id = document.querySelector(".details .unique_id").innerText;

const url = `getMessages.php?user_id=${user_id}`;

var previousChildCount = chatbox.childElementCount;
console.log('count: ' + previousChildCount);
var currentChildCount;

function fetchData() {
    
    fetch(url)
    .then(response => response.json())
    .then(data => {

        chatbox.innerHTML = "";

        data.forEach((msg) => {

            if (msg.msg_sender_uid == session_id) {
                const sendingdiv = document.createElement('div');
                sendingdiv.classList.add('chat', 'sending');
                chatbox.appendChild(sendingdiv);

                const detsdiv = document.createElement('div');
                detsdiv.classList.add('details');
                sendingdiv.appendChild(detsdiv);

                const msgPara = document.createElement('p');
                msgPara.innerText = msg.message_text;
                detsdiv.appendChild(msgPara);
            } else {
                const sendingdiv = document.createElement('div');
                sendingdiv.classList.add('chat', 'receiving');
                chatbox.appendChild(sendingdiv);
                
                const imgDiv = document.createElement('img');
                imgDiv.src = "./User-content/pfp/" + msg.img;
                sendingdiv.appendChild(imgDiv);

                const detsdiv = document.createElement('div');
                detsdiv.classList.add('details');
                sendingdiv.appendChild(detsdiv);
        
                const msgPara = document.createElement('p');
                msgPara.innerText = msg.message_text;
                detsdiv.appendChild(msgPara);
            }
        });

        var lastMess = chatbox.lastChild;
        if (lastMess.className.includes('sending')) {
            const sent = document.createElement('div');
            sent.className  = 'status';
            sent.textContent = 'sent';
            chatbox.appendChild(sent);
            if(data[data.length -1].msg_status !== 'seen') {
                const xchild = lastMess.querySelector('.details').querySelector('p');
                xchild.className = 'unseen';
            }
        } else {
            if(data[data.length -1].msg_status !== 'seen') {
                const xchild = lastMess.querySelector('.details').querySelector('p');
                xchild.className = 'unseen';
            }
        }

        var child = chatbox.lastChild;
        child.setAttribute('data-hidden-value', data[data.length -1].msg_status);
        hiddenValue = child.getAttribute('data-hidden-value');

        currentChildCount = chatbox.childElementCount;
        console.log('current: ' + currentChildCount);
        console.log('previous: ' + previousChildCount);
        if (currentChildCount > previousChildCount) {
            chatbox.scrollTop = chatbox.scrollHeight;
            previousChildCount = currentChildCount;
        }
    })
    .catch(error => {
        console.error(error);
    });

}

fetchData();

setInterval(fetchData, 2500);

