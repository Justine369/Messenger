<?php 
    header("Cache-Control: no-store, no-cache, must-revalidate");
    session_start();
    if(!isset($_SESSION['user'])) {
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="10">
        <meta name="keywords" content="Mensahe, Justine Bayron, Lelouch, Luciferous">
        <meta name="description" content="Mensahe">
        <meta name="author" content="Le Louche">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User List</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
        <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <link rel="icon" type="image/x-icon" href="./resources//vampire.ico">
    </head>
    <body>
        <div class="wrapper">
            <?php
            include_once "config.php";
            $user = $con_DB->query("SELECT * FROM users WHERE unique_id = {$_SESSION['user']}");
            if ($user->num_rows > 0) {
                $row = $user->fetch_assoc();
            }
            ?>
        <div class="content">
            <img src="./User-content/pfp/<?php echo $row['img'] ?>" alt="<?php echo $row['firstname'] . " " . $row['lastname'] ?>">
            <div class="user-info">
                <div class="unique_id" hidden></div>
                <div class="name"><?php echo $row['firstname'] . " " . $row['lastname'] ?></div>
                <div class="status"><?php echo $row['status'] ?></div>
            </div>
            <a href="settings.php" class="settingsBtn">
                <i class="fas fa-cog"></i>  
            </a>
            <a href="logout.php" class="logout">
                <i class="fas fa-power-off"></i>
            </a>
        </div>
        <div class="search">
            <input type="text" placeholder="Search for friends..." id="searchBox">
        </div>
        <div class="user-container"></div>
        <script src="./JS/search.js"></script>
        <script src="./JS/friend-data.js"></script>
    </body>
    </html>
    