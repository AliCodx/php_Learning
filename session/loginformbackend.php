<?php
session_start();
if(isset($_POST["username"]) && isset($_POST["password"])){
    if(!(empty($_POST["username"]) && empty($_POST["password"]))){
        $username = $_POST["username"];
        $password = $_POST["password"];
    }
}
if($username == "admin" && $password == "1234"){
    $_SESSION["username"] = $username;
    $_SESSION["login_time"] = time();

    header("Location: dashboard.php");
    exit;
}