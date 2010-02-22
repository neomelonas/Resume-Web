<?php
include ("../conf/settings.php");
if (isset($_SESSION['user'])){
    header( "Location: ".$uriPath."admin/index.php?u=".$slug );
}
//$message = "Username or password was <span class=\"bad\">incorrect</span>, please try again.";
$error = 0;
if (isset($_GET['e'])){
    $error = $_GET['e'];
}
switch ($error){
    case 1:
        $message = "Please enter a <span class=\"bad\">username</span>!";
	break;
    case 2:
	$message = $message . "Please enter a <span class=\"bad\">password</span>!";
	break;
    case 3:
	$message = "Bad <span class=\"bad\">username</span> or <span class=\"bad\">password</span>!";
	break;
    default:
	break;
}
?>
<!doctype html>
<html>
    <head>
        <title>Login | R&eacute;sum&eacute; Admin</title>
	<link rel="stylesheet" href="../lib/css/admin.css" type="text/css" media="screen" />
      </head>
      <body>
	  <header id="login">
	      <h1>R&eacute;sum&eacute; Admin Login</h1>
	  </header>
	<div id="message">
	    <?php
	    echo $_SESSION['ID'];
	    if (isset($message)){
		echo "<p>" . $message . "</p>";
	    }
	    ?>
	</div>
	<div id="loginform">
	    <form name="whereinwelogin" action="index.php" method="post">
		<label for="uname">Username</label>
		<input type="text" name="uname" value="" size="25" />
		<label for="pwrd">Password</label>
		<input type="password" name="pwrd" value="" size="25" />
		<input type="hidden" value="1" name="junk" />
		<input type="submit" value="Log In" name="login" />
	    </form>
	</div>
    </body>
</html>
