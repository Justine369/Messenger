<?php 
    session_start();
    if (!isset($_SESSION['user'])) {
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Profile Picture</title>
</head>
<body>
    <div class="wrapper">
        <?php 
            include_once 'config.php';
            $sql = $con_DB->query("SELECT * FROM users WHERE unique_id = {$_SESSION['user']}");
            if ($sql->num_rows > 0) {
                $user = $sql->fetch_assoc();
            }
        ?>
        <div class="settings">

            <header>
                <a href="settings.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <h2 class="header">Settings</h2>
            </header>
            
            <div class="PfpContainer">
                <div class="Err">
                    <p>This is an error! A fucking error!</p>
                </div>
                <div class="change-profile">
                    <img src="./User-content/Pfp/<?php echo $user['img']?>" alt="">
                    <label for="pfpUpload" >Select</label>
                </div>
                <form action="#" enctype="multipart/form-data">
                    <H3>Personal details:</H3>
                    <input type="file" name="pfpUpload" id="pfpUpload">
                    <input type="text" name="name" class="name" placeholder="name">
                    <input type="text" name="surname" class="surname" placeholder="surname">
                    <input type="text" name="email" class="email" placeholder="email">
                    <input type="submit" value="Save" name="Upload">
                </form>
            </div>
        </div>
    </div>
    <script src="./JS/changePFP.js"></script>
</body>
</html>