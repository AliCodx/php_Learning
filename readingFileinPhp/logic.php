<?php
if(isset($_POST["create&Save"])){
  
    if(isset($_POST["fileName"])){
    $fileName = "files/{$_POST["fileName"]}";
}
    $file = fopen($fileName,"w");

    if(isset($_POST["content"])){
    $content = $_POST["content"];
}
    if(fwrite($file,$content)){
        echo "File is Created and content Saved";
    }
    fclose($file);
}
// logic for reading the file
if(isset($_POST["read"])){
    if(isset($_POST["fileName"])){
    $filePath = "files/{$_POST["fileName"]}";
    $content = file_get_contents($filePath);
    echo $content;
}
}


