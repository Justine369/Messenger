<?php
    session_start();
    include_once "config.php";


    //Checks the users(friends) other than user logged-in.
    $sqlGetUsers = $con_DB->query("SELECT * FROM users WHERE NOT unique_id = {$_SESSION['user']}");
    
    if ($sqlGetUsers->num_rows > 0) {
        $users = $sqlGetUsers->fetch_all(MYSQLI_ASSOC);
        $user_UniqueIDs = array_column($users, "unique_id");
        $user_UniqIDStr = implode(',', $user_UniqueIDs);
        $user_IDs = array_column($users, "user_id");
        $user_IDStr = implode(',', $user_IDs);

        $sqlGetlastMSG = $con_DB->query("SELECT *
            FROM messages
            LEFT JOIN users ON messages.msg_sender_uid = users.unique_id
            WHERE msg_id IN (
                SELECT MAX(msg_id)
                FROM messages
                WHERE msg_sender_uid IN ({$user_UniqIDStr})
                AND msg_receiver_uid = (SELECT user_id FROM users WHERE unique_id = {$_SESSION['user']})
                GROUP BY msg_sender_uid, msg_receiver_uid
            )
        ");
    
        if ($sqlGetlastMSG->num_rows > 0) {
            echo json_encode($sqlGetlastMSG->fetch_all(MYSQLI_ASSOC));
        }
    }

            // SELECT * FROM messages 
        // LEFT JOIN users ON users.unique_id = messages.msg_sender_uid
        // WHERE (msg_sender_uid = '196274766' AND msg_receiver_uid = '16') OR (msg_sender_uid = (SELECT unique_id FROM users WHERE user_id = '16') AND msg_receiver_uid = (SELECT user_id FROM users WHERE unique_id = '196274766')) ORDER BY msg_id;

        // $user_IDs = array_column($users, "user_id");
        // $user_IDStr = implode(',', $user_IDs);

        // $user_UniqueIDs = array_column($users, "unique_id");
        // $user_UniqIDStr = implode(',', $user_UniqueIDs);

        // $sqlGetlastMSG = $con_DB->query("SELECT lastMSG.message_text, users.user_id, users.firstname, users.lastname, users.status, users.img FROM users 
        // LEFT JOIN (SELECT msg_sender_uid, msg_receiver_uid, message_text FROM messages WHERE msg_id IN (SELECT MAX(msg_id) FROM messages GROUP BY msg_sender_uid, msg_receiver_uid)) AS lastMSG
        // ON users.unique_id = lastMSG.msg_sender_uid OR users.user_id = lastMSG.msg_receiver_uid
        // WHERE user_id IN ($user_IDStr)
        // ");

?>







