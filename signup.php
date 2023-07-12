<?php
    session_start();
    include_once "config.php";
    $fname = $con_DB->real_escape_string($_POST['fname']);
    $lname = $con_DB->real_escape_string($_POST['lname']);
    $email = $con_DB->real_escape_string($_POST['email']);
    $pass = $con_DB->real_escape_string($_POST['password']);

    if (!empty($fname) && !empty($lname) && !empty($email) && !empty($pass)) {
        $sqlEmailTaken = $con_DB->query("SELECT * FROM users where email = '$email'");
        if (!$sqlEmailTaken->num_rows > 0) {
            $hashedPass = password_hash($pass, PASSWORD_ARGON2I);
            $ran_id = rand(time(), 1000000);
            $status = 'Active now';
            $img = 'whatever.png';
            $sqlSignup = "INSERT INTO users (unique_id, firstname, lastname, password, email, status, img)
            VALUES('$ran_id', '$fname', '$lname', '$hashedPass', '$email', '$status', '$img')";
            if ($con_DB->query($sqlSignup)) {
                $_SESSION["user"] = $ran_id;
                echo "success"; 
            } else {
                echo "Something went wrong!";
            }
        } else {
            echo "Email is already taken.";
        }
    }
?>