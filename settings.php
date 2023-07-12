<?php 
    session_start();
    if(!isset($_SESSION['user'])) {
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <title>Document</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="settings">

                <header>
                    <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                    <h2 class="header">Settings</h2>
                </header>

                <div class="settings-content">
                    <a href="changePfppage.php" class="settings-items">Personal Information</a>
                        <a href="changePass.php" class="settings-items">Password</a>
                        <a href="#" class="settings-items">Delete account</a>
                        <a href="logout.php" class="settings-items">Logout</a>

                </div>
                
            </div>
        </div>

        <script src="./JS/settings.js"></script>
        
    </body>
    
</html>