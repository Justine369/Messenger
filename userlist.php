<?php
    session_start();
    header('Content-Type: text/event-stream');
    header('Cache-Control: no-cache');
    // header('Connection: keep-alive');

    ob_end_flush();
    $response;

    include_once "config.php";

    //Checks the users(friends) other than user logged-in.
    $sqlGetUsers = $con_DB->query("SELECT * FROM users WHERE NOT unique_id = {$_SESSION['user']}");
    if (!$sqlGetUsers) {
        die("Error in query: " . $con_DB->error);
    }

    if ($sqlGetUsers->num_rows > 0) {
        $users = $sqlGetUsers->fetch_all(MYSQLI_ASSOC);

        $user_UniqueIDs = array_column($users, "unique_id");
        $user_UniqIDStr = implode(',', $user_UniqueIDs);
        $user_IDs = array_column($users, "user_id");
        $user_IDStr = implode(',', $user_IDs);

        $sqlGetlastMSG = $con_DB->query("SELECT firstname, img, lastname, message_text, user_id, msg_status
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
            $response = $sqlGetlastMSG->fetch_all(MYSQLI_ASSOC);
        }
    }


    echo "data: " . json_encode($response) . "\n\n";
    flush();

?>







