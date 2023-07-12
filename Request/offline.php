<?php 
    session_start();
    include_once "../config.php";
    $sqlOffline = $con_DB->query("UPDATE users SET status = 'Offline' WHERE unique_id = {$_SESSION['user']}");
?>