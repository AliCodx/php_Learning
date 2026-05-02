<?php
session_start();
if($_POST["button"] = "logout"){
    session_unset();
    session_destroy();
    header("Location: loginform.php");
}else{
    session_unset();
    session_destroy();
    header("Location: loginform.php");
}



