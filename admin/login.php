<?php
include ("../conf/settings.php");
if (isset($_SESSION['ID'])){
    header( "Location: ".$uriPath."admin/index.php" );
}
if (isset($_GET['uname'])){
    if (!isset($_GET['pwrd'])){
	$message = "Please enter a password.";
    }
    else {
	$uname = $_GET['uname'];
	$sql = $dbcon->query("SELECT password FROM res_user WHERE username LIKE '". $dbcon->real_escape_string(strip_tags(stripslashes($uname))) ."'");
	if ($sql) { $message = "Username or password was incorrect, please try again."; }
	while($row = $sql->fetch_object()){
	    if (sha1($_GET[pwrd]) != $row->password){
		$message = "Username or password was incorrect, please try again.";
	    }
	    else {
		session_start();
		$ID = substr(md5($uname),0,6);
		$_SESSION['ID'] = $ID;
		header( "Location: ".$uriPath."admin/index.php" );
	    }
	}
    }
}
?>
<!doctype html>
<html>
    <head>
        <title>Login | R&eacute;sum&eacute; Admin</title>
    </head>
    <body>
	<div id="message">
	    <?php
	    echo $_SESSION['ID'];
	    if (isset($message)){
		echo "<p>" . $message . "</p>";
	    }
	    ?>
	</div>
	<div id="loginform">
	    <form name="whereinwelogin" action="login.php" method="GET">
		<label for="uname">Username</label>
		<input type="text" name="uname" value="" size="25" />
		<label for="pwrd">Password</label>
		<input type="password" name="pwrd" value="" size="25" />
		<input type="submit" value="Log In" name="" />
	    </form>
	</div>
    </body>
</html>
