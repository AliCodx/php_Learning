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


