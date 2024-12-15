var c = 0;

function checkSeen() {
        const xx = document.querySelector(".chat-box");
        const inputMSG = document.querySelector('.inputMsg');
        var child = xx.lastChild;
        var seen = child.dataset.hiddenValue;

        if (seen !== 'seen') {
            console.log('not seen');
            
                xx.addEventListener('mouseover', () => {
                    if (c < 1) {
                        sendSeen();
                     }
                });

                inputMSG.addEventListener('focus', () => {
                    if (c < 1) {
                        sendSeen();
                     }
                });

        } else {
            console.log(seen);
        }
}

setInterval(checkSeen, 3000);


function sendSeen() {
    console.log(c);
    fetch('/Request/updateSeen.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
    })
    .then(response => response.json()) 
    .then(data => console.log(data))
    .catch(err => console.error(err));
    c++;
}