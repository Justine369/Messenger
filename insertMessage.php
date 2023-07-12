<?php 
    session_start();
    if (!isset($_SESSION['user'])) {
        header("location: login.php");
    }
    include_once "config.php";
    $requestData = json_decode(file_get_contents("php://input"), true);
    $uid = intval($requestData['user_id']);
    $session_id = intval($_SESSION['user']);
    $message = $con_DB->real_escape_string($requestData['message']);

    
    
    $sqlInsertMessage = "INSERT INTO messages (msg_sender_uid, msg_receiver_uid, message_text) 
    VALUES('{$session_id}', '{$uid}', '{$message}')";
    
    if ($con_DB->query($sqlInsertMessage) === TRUE) {
        echo $uid . " " . $message;
    } else {
        echo "Error: " . $con_DB->error;
    }
    

?>