<?php  session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="backendLogic/loginBackend.php" method="post">
        <fieldset>
            <legend>Login Form</legend>
            <label>Name</label>
            <input type="text" placeholder="Enter Your Name"  name="nameField" />
            <label>Password</label>
            <input type="password" placeholder="Enter Your Password"  name="passwordField" />
            <button value = "login">Login</button>
            <a href="#">Forget Password?</a>
            <a href="signup.php">Sign up</a>
        </fieldset>
    </form>
</body>
</html>
