<?php session_start() ?>
<html>
<head>
    <title>Login Form</title>
</head>
<body>
    <form action="loginformbackend.php" method="post">
        Username : <input type="text" name="username" />
        <br/>
        <br/>
        Password : <input type="password" name="password" />
        <br/>
        <br/>
        <button>Submit</button>
    </form>
</body>
</html>