<?php
    session_start();
    include_once "config.php";
    $sql_logout = $con_DB->query("UPDATE users SET status = 'Offline' WHERE unique_id = {$_SESSION['user']}");
    session_unset();
    if(!isset($_SESSION['user'])) {
        header("location: index.php");
    }
?>