<?php

require_once 'lib/class/Membership.php';
$membership = New Membership();

$membership->confirm_Member();

?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Untitled Document</title>
	<link rel="stylesheet" href="css/default.css" />
	<!--[if lt IE 7]>
	    <script type="text/javascript" src="lib/js/DD_belatedPNG_0.0.7a-min.js"></script>
	<![endif]-->
    </head>
    <body>
	<div id="container">
	    <p>
		You've reached the page that stores all of the secret launch codes!
	    </p>
	    <a href="login.php?status=loggedout">Log Out</a>
	</div><!--end container-->
    </body>
</html>
