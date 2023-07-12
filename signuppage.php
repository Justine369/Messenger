<?php
    session_start();
    if(isset($_SESSION['user'])) {
        header("location: user.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="./CSS/signup.css">
</head>
<body>
    
    <div class="container">
        <h2>Sign Up</h2>
        <form action="#">
            <label for="name">First name:</label>
            <input type="text" id="fname" name="fname" required>

            <label for="surname">Last name:</label>
            <input type="text" id="lname" name="lname" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <div class="password-wrapper">
                <label for="password">Password:</label>
                <input type="password" id="password" class="password-input" name="password" required>
                <label for="password" class="password-toggle">&#x1f441;</label>
            </div>
            
            <div class="field button">
                <button type="submit">Sign Up</button>
            </div>
            <p>Have an account? <a href="loginpage.php">Log in</a></p>
        </form>
    </div>
    
    <script src="./JS/password-toggle.js"></script>
    <script src="./JS/signup.js"></script>
</body>
</html>
