<?php  
session_start();
$signupError = $_SESSION["signup_error"] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <form action="backendLogic/signupBackend.php" method="post">
        <fieldset>
            <legend>Sign Up</legend>
            <?php
                if($signupError != null){
                    echo "Both Name & Password are Required";
                    session_unset();
                }
            ?>
            <label>Name</label>
            <input type="text" placeholder="Enter Your Name"  name="nameField" />
            <label>Password</label>
            <input type="password" placeholder="Enter Your Password"  name="passwordField" />
            <button name = "signup" value ="signup" >Create new Account</button>
        </fieldset>

    </form>
</body>
</html>
