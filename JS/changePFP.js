const err = document.querySelector('.Err');
const pfp = document.querySelector(".change-profile img");
const fileLabel = document.querySelector('.change-profile label');
const form = document.querySelector(".PfpContainer form");
const file = document.querySelector(".PfpContainer input[type='file']");
const fileUpload = document.querySelector(".PfpContainer input[type='submit']");
const inputText = document.querySelectorAll("form input[type='text']");
const url = './Request/changePfp.php';

form.addEventListener('submit', (e) => {
    e.preventDefault();
});

file.addEventListener('change', (event) => {

    // the same as file.files
    let fileList = event.target.files[0];

    if (fileList) {
        
        if (fileList.type.startsWith('image/')) {

            const reader = new FileReader();
            
            reader.addEventListener('load', () => {
                pfp.src = reader.result;
                fileLabel.innerHTML = fileList.name;
            });
            
            reader.readAsDataURL(fileList);

        } else {
            err.innerHTML = 'Select an image file!';
            err.style.display = 'block';
            err.style.backgroundColor = '#1d1d1d';
                err.style.color ='rgb(223, 0, 0)';
                err.style.border = '1px solid rgb(118, 0, 0)';

            setTimeout(() => {
                err.style.display = 'none';
            }, 3000);
            file.value = '';
        }  

    } 

});




const isEmpty = (texts) => {

    let isTextEmpty = true;
    
    for (const text of texts) {
        if (text.value.length !== 0) {
            isTextEmpty = false;
            break;
        }
    }

    let fileList = file.files[0];

    if (fileList) {
        isTextEmpty = false;
    }

    return isTextEmpty;
};


fileUpload.addEventListener('click', () => {

    let formData = new FormData(form);
    
    if (!isEmpty(inputText)) {

        fetch(url, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                err.style.display = 'block';
                err.innerHTML = 'Successfully saved!';
                err.style.display = 'block';
                err.style.color = 'White';
                err.style.backgroundColor = '#111716';
                err.style.borderColor = '#004544';

                setTimeout(() => {
                    window.location.href = '../user.php';
                }, 1000);
            } else {
                err.innerHTML = data.err;
                err.style.display = 'block';
                err.style.backgroundColor = '#1d1d1d';
                err.style.color ='rgb(223, 0, 0)';
                err.style.border = '1px solid rgb(118, 0, 0)';

                setTimeout(() => {
                    err.style.display = 'none';
                }, 5000);
                
            }
        })
        .catch(error => console.log(JSON.stringify(error)));

    } else {
        err.innerHTML = 'Input is required!';
        err.style.display = 'block';
        err.style.color = 'White';
        err.style.backgroundColor = '#111716';
        err.style.borderColor = 'gray';

        setTimeout(() => {
            err.style.display = 'none';
        }, 3000);
    }
    
    fileLabel.innerHTML = 'Select';
    fileLabel.style.color = 'white';
    file.value = '';
    
    inputText.forEach(text => {
        if (text.value.length !== 0) {
            text.value = '';
        }
    });

})