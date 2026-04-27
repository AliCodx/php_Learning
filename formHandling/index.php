<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Handling in php</title>
</head>
<body>
    <form action="backend.php" method="post">
    Name :
    <br/>
    <input type = "text" name = "name" />
    <br/>
    <br/>
    Male : <input type= "radio" name="gender" value="male" />
    Female : <input type= "radio" name="gender" value="Female" />
    <br/>
    <br/>
    Your Skills :
    <br/>
    Web developer  <input type= "checkbox" name="skill[]" value="web dev" />
    Mobile developer  <input type= "checkbox" name="skill[]" value="Mobile dev" />
    <br/>
    <br/>
    Experience :
    <select name="experience">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
    years
    </br>
    <br/>
    <button >Submit<button>
    
    </form>
</body>
</html>