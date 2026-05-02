<?php
session_start();
$name = $_POST["nameField"];
$password = $_POST["passwordField"];

include("../db/dbConnectivity.php");
$query = "select * from `login_detail` where `name`='$name' and `password`='$password'";
$result = $connect->query($query);
print_r($result);
