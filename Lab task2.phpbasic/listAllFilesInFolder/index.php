<?php
$path = "files";
$list = scandir($path);
$list = array_diff($list,array(".",".."));
echo "List of All Files";
echo "<br/>";
foreach ($list as $key => $value){
    echo "<a href=files/$value>{$value}</a>";
    echo "<br/>";

}
