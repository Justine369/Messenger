<?php
    session_start();
    include_once "config.php";
    $user_id = intval($con_DB->real_escape_string($_GET['user_id']));

    $sqlGetMessages = $con_DB->query("SELECT * FROM messages 
    LEFT JOIN users ON users.unique_id = messages.msg_sender_uid
    WHERE (msg_sender_uid = {$_SESSION['user']} AND msg_receiver_uid = '{$user_id}')
    OR (msg_sender_uid = (SELECT unique_id FROM users WHERE user_id = {$user_id}) AND msg_receiver_uid = (SELECT user_id FROM users WHERE unique_id = {$_SESSION['user']})) ORDER BY msg_id");
    if ($sqlGetMessages->num_rows > 0) {
        $messages = $sqlGetMessages->fetch_all(MYSQLI_ASSOC);
        echo json_encode($messages);
    } 

?>