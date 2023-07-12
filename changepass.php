<?php 
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: index.php');
    }
    include_once "config.php";
    $sql = $con_DB->query("SELECT * FROM users WHERE unique_id = {$_SESSION['user']}");
    if ($sql->num_rows > 0) {
        $user = $sql->fetch_assoc();
    } else {
        echo $con_DB->error;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" href="./CSS/style.css">
    </head>
    <body>
        <div class="wrapper">
            <div class="settings">
                <header>
                    <a href="settings.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <h2 class="header">Settings</h2>
                </header>
                <div class="PfpContainer">
                    <div class="Err">
                        <p>This is an error! A fucking error!</p>
                    </div>
                    <div class="change-pass">
                        <img src="../User-content/Pfp/<?php echo $user['img']?>" alt="<?php echo $user['firstname'] . $user['lastname']?>">
                    </div>
                    <h3>Change Password</h3>
                    <form action="#">
                        <input type="password" name="confirmpwd" class="pass" placeholder="Current password">
                        <input type="password" name="newpwd" class="pass" placeholder="New password">
                        <input type="password" name="cnewpwd" class="pass" placeholder="Confirm new password">
                        <input type="submit" value="Change Password" name="submit">
                    </form>
                    <script src="./JS/changePass.js"></script>
                </div>
            </div>
        </div>
    </body>
</html>
