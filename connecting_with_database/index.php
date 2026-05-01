<?php
$host = "127.0.0.1";
$user = "root";
$password = "Hello";
$database = "mydatabase";
$connection = new mysqli($host,$user,$password,$database);

if($connection -> connect_error){
    die("databse connection failed {$connection -> connect_error}");
}
else{
    echo "Database connection succeed";
    echo "<br/>";
}

$result = $connection -> query("select * from student");
while($row = $result->fetch_assoc()){
    print_r($row);
    echo "<br/>";
}