<?php 
    session_start();
    include_once "../config.php";


    // $sql = "UPDATE messages
    //     JOIN (
    //         SELECT MAX(msg_id) AS max_msg_id
    //         FROM messages
    //         WHERE msg_receiver_uid = (
    //             SELECT user_id
    //             FROM users
    //             WHERE unique_id = {$_SESSION['user']}
    //         )
    //         AND 
    //         msg_sender_uid = (
    //             SELECT unique_id
    //             FROM users
    //             WHERE user_id = {$_SESSION['user_id']}
    //         )
    //     ) AS subquery
    //     SET messages.msg_status = 'seen'
    //     WHERE messages.msg_id = subquery.max_msg_id;";


    $sql = "UPDATE messages SET msg_status = 'seen' 
    WHERE msg_receiver_uid = (
        SELECT user_id
        FROM users
        WHERE unique_id = {$_SESSION['user']}
    )
    AND 
    msg_sender_uid = (
        SELECT unique_id
        FROM users
        WHERE user_id = {$_SESSION['user_id']}
    )";

    if ($con_DB->query($sql) === TRUE) {
       $x = "Update successful";
    } else {
        $x = "Update x";
    }

    echo json_encode(['d' => 'asd']);
?>  