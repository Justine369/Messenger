<?php 
  ini_set('session.gc_maxlifetime', 900);
  session_start();
  if(isset($_SESSION['user'])) {
    header("location: user.php");
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
  <link rel="stylesheet" type="text/css" href="./CSS/login.css">
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <form>
      <input type="text" placeholder="Email" name="email" required>
      <div class="password-wrapper">
        <input type="password" placeholder="Password" id="password" name="password" class="password-input" required>
        <label for="password" class="password-toggle">&#x1f441;</label>
      </div>
      <div class="button">
        <button type="submit">Login</button>
      </div>
    </form>
    <p>Don't have an account? <a href="signuppage.php">Sign up</a></p>
  </div>

  <script src="./JS/password-toggle.js"></script>
  <script src="./JS/login.js"></script>
</body>
</html>
