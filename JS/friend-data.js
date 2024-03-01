const userContainer = document.querySelector(".user-container");

const getOnlineFriends = async () => {

  const response = await fetch("userlist.php");
  const onlineFriends = await response.json();
  console.log(onlineFriends);
  
  if(onlineFriends.length > 0) {
    
    userContainer.innerHTML = "";
    
    onlineFriends.forEach((friend) => {
      
      // console.log(friend);

          const uid = friend.user_id;
          const firstName = friend.firstname;
          const lastName = friend.lastname;
          const message = friend.message_text;
          const status = friend.status;
          const img = "./User-content/pfp/" + friend.img;

          const userDiv = document.createElement('div');
          userDiv.classList.add('user');
          userContainer.appendChild(userDiv);

          userDiv.addEventListener('click', () => {
              const uid = userDiv.querySelector(".unique_id").innerText;
              location.href = `chat.php?uid=${uid}`;
            });
  
          const userImg = document.createElement('img');
          userImg.src = img;
          userImg.alt = firstName;
          userDiv.appendChild(userImg);
  
          const uniqueIdDiv = document.createElement('div');
          uniqueIdDiv.classList.add('unique_id');
          uniqueIdDiv.setAttribute('hidden', true);
          uniqueIdDiv.innerText = uid;
          userDiv.appendChild(uniqueIdDiv);
  
          const userInfoDiv = document.createElement('div');
          userInfoDiv.classList.add('user-info');
          userDiv.appendChild(userInfoDiv);
  
          const nameDiv = document.createElement('div');
          nameDiv.classList.add('name');
          nameDiv.innerText = firstName + " " + lastName;
          userInfoDiv.appendChild(nameDiv);
  
          const statusDiv = document.createElement('div');
          statusDiv.classList.add('message');
          statusDiv.innerText = message;
          userInfoDiv.appendChild(statusDiv);

          const activeDiv = document.createElement('i');
          activeDiv.classList.add('fas', 'fa-circle', 'fa-xs');
          activeDiv.style.marginLeft = 'auto';
          activeDiv.style.fontSize = '.50em';

          if (status == 'Active now') {
            activeDiv.style.color = '#00cccc';
          } else {
            activeDiv.style.color = '#bfbfbf';
          }

          userDiv.appendChild(activeDiv);
          
          
      })
  } else {
      // server sent out an empty list
      console.log("No Online Friends");
  }
}


getOnlineFriends();

// setInterval(getOnlineFriends, 10000);

