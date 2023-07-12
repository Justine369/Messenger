<?php
    session_start();
    include_once "config.php";

    $sqlGetUsers = $con_DB->query("SELECT * FROM users WHERE NOT unique_id = {$_SESSION['user']}");
    
    if ($sqlGetUsers->num_rows > 0) {
        
        $users = $sqlGetUsers->fetch_all(MYSQLI_ASSOC);
        // echo json_encode($users);

        $user_IDs = array_column($users, "user_id");
        $user_IDStr = implode(',', $user_IDs);

        $user_UniqueIDs = array_column($users, "unique_id");
        $user_UniqIDStr = implode(',', $user_UniqueIDs);

        $sqlGetlastMSG = $con_DB->query("SELECT lastMSG.message_text, users.user_id, users.firstname, users.lastname, users.status, users.img FROM users 
        LEFT JOIN (SELECT msg_sender_uid, msg_receiver_uid, message_text FROM messages WHERE msg_id IN (SELECT MAX(msg_id) FROM messages GROUP BY msg_sender_uid, msg_receiver_uid)) AS lastMSG
        ON users.unique_id = lastMSG.msg_sender_uid OR users.user_id = lastMSG.msg_receiver_uid
        WHERE user_id IN ($user_IDStr)
        ");

        if ($sqlGetlastMSG->num_rows > 0) {
            echo json_encode($sqlGetlastMSG->fetch_all(MYSQLI_ASSOC));
        } 
        
    }

    

    // list of users and find those userlist's last messages
    // if ($sqlGetUsers->num_rows > 0) {
    //     echo json_encode($sqlGetUsers->fetch_all()); 
    // } else {
    //     echo "[]";
    // }


    // if ($sqlGetUsers->num_rows > 0) {
    //     while($row = $sqlGetUsers->fetch_assoc()) {
    //         $response .= <<<EOD
    //         <div class="user">
    //         <img src="https://picsum.photos/100/100" alt="John Doe">
    //         <div class="unique_id" hidden>{$row['unique_id']}</div>
    //             <div class="user-info">
        //             <div class="name">{$row['firstname']} {$row['lastname']}</div>
        //             <div class="status">{$row['status']}</div>
    //             </div>
    //         </div>
    //     EOD;
    //     }
    // } else {
    //     $response = "No available users";
    // }

?>







