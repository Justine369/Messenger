const form = document.querySelector(".PfpContainer form");
const submitBTN = document.querySelector("input[type='submit']");
const InputPass = document.querySelectorAll("input[type='password']");

const err = document.querySelector('.PfpContainer .Err');
const url = "./Request/changePass.php"

form.addEventListener('submit', (e) => {

    e.preventDefault();

    const isEmpty = (inputs) => {

        let isPassEmpty = false;
        
        for (const pass of inputs) {
            if (pass.value.length === 0) {
                isPassEmpty = true;
                break;
            }
        }
        return isPassEmpty;
    };


    if (!isEmpty(InputPass)) {
        
        let formdata = new FormData(form);
        fetch(url, {
            method: 'POST',
            body: formdata
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (Object.keys(data).length > 0) {
                err.style.display = 'none';
    
                if (Object.keys(data)[0] == 'success') {
                    err.style.color = 'White';
                    err.style.backgroundColor = '#111716';
                    err.style.borderColor = '#004544';
    
                } else {
                    err.style.backgroundColor = '#1d1d1d';
                    err.style.color ='rgb(223, 0, 0)';
                    err.style.border = '1px solid rgb(118, 0, 0)';
                }
                setTimeout(()=> {
                    err.innerHTML = data[Object.keys(data)[0]];
                    err.style.display = 'block';
                }, 25);
                
                
            }
        })
        .catch(error => console.log(error));
    
        InputPass.forEach(pass => {
            pass.value = '';
        });
    } else {

        err.style.display = 'none';
        err.style.backgroundColor = '#1d1d1d';
        err.style.color ='rgb(223, 0, 0)';
        err.style.border = '1px solid rgb(118, 0, 0)';
        err.innerHTML = "All field are required!";

        setTimeout(()=> {
            err.style.display = 'block';
        }, 50);
    }

});