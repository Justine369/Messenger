<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <link rel="stylesheet" type="text/css" href="./CSS/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "config.php";
                $user_id = $con_DB->real_escape_string($_GET['uid']);
                $user = $con_DB->query("SELECT * FROM users WHERE user_id = {$user_id}");
                if ($user->num_rows > 0) {
                    $row = $user->fetch_assoc();
                }
               
                ?>
                <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="./User-content/pfp/<?php echo $row['img']?>" alt="name">
                <div class="details">
                    <div class="unique_id" hidden><?php echo $row['user_id']?></div>
                    <span><?php echo $row['firstname'] . " " . $row['lastname']?></span>
                    <p><?php echo $row['status']?></p>
                </div>
            </header>
            <div class="chat-box">
                <div class="session_user" hidden><?php echo $_SESSION['user'] ?></div>
                <!-- <div class="chat sending">
                    <div class="details">
                        <p>Hi</p>
                    </div>
                </div>
                <div class="chat receiving">
                    <img src="<?php echo $row['img'] ?>" alt="name">
                    <div class="details">
                        <p>Hellasdasdasdasdasdasdasdasdo</p>
                    </div>
                </div> -->
            </div>
            <form action="#" class="typing-area">
                <input type="text" placeholder="Type a message here..." name="" id="" class="t">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="./JS/updateMessages.js"></script>
    <script src="./JS/messages.js"></script>


</body>

</html>