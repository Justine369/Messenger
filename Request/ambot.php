<?php
    session_start();
    // echo json_encode(['data' => $_SESSION['user'], 'success' => true]);
    if (isset($_SESSION['user_id'])) {
        // 'user_id' exists in the $_SESSION array
        echo "User ID is set: " . $_SESSION['user_id'] . "USER " . $_SESSION['user'];
    } else {
        // 'user_id' does not exist in the $_SESSION array
        echo "User ID is not set"  . "USER " . $_SESSION['user'];
    }
?>