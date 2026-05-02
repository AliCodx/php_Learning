<?php
session_start();

// logout the user when session destroy or session duration end.
if(!isset($_SESSION["username"]) || time()-$_SESSION["login_time"] > 1000){
    header("Location: logout.php");
}
// logout the user if no activity
if(isset($_SESSION["last_activity"])){
    if(time()-$_SESSION["last_activity"]>10){
    header("Location: logout.php");
}
}



?>
<h1>Welcome to Dashboard</h1>
<h2>welcome to <?= $_SESSION["username"] ?> </h2> 
<form action="logout.php" method="post">
    <button name="button" value="logout">Logout</button>
</form>

<?php $_SESSION["last_activity"] = time(); ?>
