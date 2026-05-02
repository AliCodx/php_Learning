<html lang="en">
<head>
    <title>creating_File_In_Php</title>
</head>
<body>
    <form action="logic.php" method="post">
    File Name : 
    <br/>
    <br />
    <input type="text" placeholder="Enter the file Name with .txt extension" name="fileName" style="width:250px; "/>
    <br/>
    <br/>
    Content :
    <br/>
    <textarea name = "content" style="width :250px; height:200px;"></textarea> 
    <br/>
    <br/>
    <button name="create&Save">Create & Save</button>
    <button name="read">Read</button>
</form>
</body>
</html>