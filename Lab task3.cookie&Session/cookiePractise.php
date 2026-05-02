<html>
<head></head>
<body>
	<form method="post" action="">
		Username : <input type="text" name="username">
</br>
</br>
		<button name="button" value="set">SetCookie</button>
</br>
</br>
		<button name="button" value="display"> DisplayCookie</button>
</br>
</br>
		<button name="button" value="delete"> DeleteCookie</button>
	</form>

</body>  
</html>
<?php
	if(!empty($_POST["username"]) && isset($_POST["username"])){
		$value = $_POST["username"];
		if($_POST["button"] == "set"){
			setcookie("username","$value");
		}
	}
	if($_POST["button"]= "display"){
			if(isset($_COOKIE["username"])){
				echo $_COOKIE["username"];
			}
		}
	if($_POST["button"]= "delete"){
		if(isset($_COOKIE["username"])){
				setcookie("username",null,-1);
			}
	}
?>