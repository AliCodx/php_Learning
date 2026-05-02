<?php
$myArray = ["name"=>"Ali","age"=>20,"email"=>"ali.abid3889@gmail.com"];
print_r($myArray);
echo "<br/>";
echo "<br/>";
// convert the above array into Json.
$myArrayInJson = json_encode($myArray);
print_r($myArrayInJson); 
echo "<br/>";
echo "<br/>";
// convert the Json into array.
$json = $myArrayInJson;
$myJsonInArray = json_decode($json,true);
print_r($myJsonInArray);