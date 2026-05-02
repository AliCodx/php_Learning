<?php
$host = '127.0.0.1';
$user = "root";
$password = "Hello";
$database = "crud";
$connect = new mysqli($host,$user,$password,$database);
if($connect->connect_error){
    die("connection failed");
}
