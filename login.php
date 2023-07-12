<?php 
    session_start();
    include_once "config.php";
    $email = $con_DB->real_escape_string($_POST['email']);
    $pass = $con_DB->real_escape_string($_POST['password']);


    
    if (!empty($email) && !empty($pass)) {
        $sql_Auth = $con_DB->query("SELECT * FROM users WHERE email = '$email'");
        if ($sql_Auth->num_rows > 0) {
            $row = $sql_Auth->fetch_assoc();
            $hashedPass = password_verify($pass, $row['password']);
            if ($hashedPass) {
                $_SESSION['user'] = $row['unique_id'];
                $sqlActive = $con_DB->query("UPDATE users SET status = 'Active now' WHERE unique_id = {$_SESSION['user']}");
                echo "success";
            } else {
                echo "Incorrect email or password.";
            }
        } else {
            echo "Incorrect email or password.";
        }
    } else {
        echo "All input required!";
    }

?>