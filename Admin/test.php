<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>
  <style>
    /* Hide the login form by default */
    .login-container {
      display: none;
    }
    /* Style the login form */
    .login-form {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 5px;
      box-sizing: border-box;
      width: 80%;
      max-width: 400px;
    }
    /* Style the form inputs */
    .login-form input[type="text"], .login-form input[type="password"] {
      margin-bottom: 20px;
      padding: 12px 20px;
      border-radius: 4px;
      border: 1px solid #ccc;
      box-sizing: border-box;
      width: 100%;
    }
    /* Style the submit button */
    .login-form input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }
  </style>
</head>
<body>
  <button id="login-button">Login</button>
  <div class="login-container">
    <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username">
      <br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <br><br>
      <input type="submit" value="Login">
    </form>
  </div>
  <script>
    // Get the login button and login container elements
    var loginButton = document.getElementById("login-button");
    var loginContainer = document.querySelector(".login-container");
    // Add an event listener to the login button
    loginButton.addEventListener("click", function() {
      // When the button is clicked, toggle the display of the login container
      loginContainer.style.display = (loginContainer.style.display === "none") ? "block" : "none";
    });
  </script>
  <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $password = $_POST['password'];
      
      // Check if the username and password match a user in the database
      // If a match is found, log the user in
      // If no match is found, display an error message
    }
  ?>
</body>
</html>
