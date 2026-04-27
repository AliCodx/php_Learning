<?php
echo "<br/>";
echo "Welcome {$_POST["name"]}";
echo "<br/>";
echo "Your Gender is {$_POST["gender"]}";
echo "<br/>";
echo "Your Skills are ";
echo "<br/>";
foreach($_POST["skill"] as $skill){
     echo $skill;
     echo "<br/>";
}
echo "You have Experinced of {$_POST["experience"]} Years";
echo "<br/>";