<?php
session_start();
if ($_POST["signup"] == "signup") {
    if (empty($_POST["nameField"]) || empty($_POST["passwordField"])) {
        $_SESSION["signup_error"] = "Username and password are required.";
        header("Location: ../signup.php");
        exit;
    }else{
        $name = $_POST["nameField"];
        $userpassword = $_POST["passwordField"];
        include("../db/dbConnectivity.php");
        $query = "INSERT INTO `login_detail` (`name`, `password`) VALUES ('{$name}', '{$userpassword}')";
        if($connect->query($query) === true){
            header("Location: ../login.php");
            exit;
        }
        
        
        

    }
}
