<?php
    include ("../conf/settings.php");
    if (!isset($_SESSION['ID'])){
	header( "Location: ".$uriPath."admin/login.php" );
    }
?>
<!doctype html>
<html>
    <head>
        <title>R&eacute;sum&eacute; Admin</title>
    </head>
    <body>
	<p>User Logged in!</p>
    </body>
</html>
