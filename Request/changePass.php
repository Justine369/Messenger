<?php 

    session_start();
    include_once "../config.php";

    $sql = $con_DB->query("SELECT password FROM users WHERE unique_id = {$_SESSION['user']}");
    if ($sql->num_rows > 0) {
        $user = $sql->fetch_assoc();
    } else {
        echo $con_DB->error;
        // header('location: index.php');
    }

    $response = [];

    if (!empty($_POST['confirmpwd']) && !empty($_POST['newpwd']) && !empty($_POST['cnewpwd'])) {
        $hashedPass = password_verify($_POST['confirmpwd'], $user['password']);
        if ($hashedPass) {
            if ($_POST['newpwd'] === $_POST['cnewpwd']) {
                $hashNewPass = password_hash($_POST['cnewpwd'], PASSWORD_ARGON2I);
                if ($changePass = $con_DB->query("UPDATE users 
                    SET password = '{$hashNewPass}'
                    WHERE unique_id = {$_SESSION['user']}")) {
                       $response['success'] = 'Your password has been changed!';
                    } else {
                        $response['errSetPass'] = "Something went wrong. Can't change password.";
                    }
            } else {
                $response['errNotMatched']= "Password did not match.";
            }
        } else {
            $response['errPass'] = 'Incorrect password.';

        }
    }

    echo json_encode($response);
?>