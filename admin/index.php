<?php
    include ("../conf/settings.php");
    if ($_POST['junk'] == 1){
	if ($_POST['uname'] == ""){
	    header( "Location: ".$uriPath."admin/login.php?e=1");
	}
	else {
	    $name = $_POST['uname'];
	}
	if ($_POST['pwrd'] == ""){
	    header( "Location: ".$uriPath."admin/login.php?e=2");
	}
	else {
	    $pwd = $_POST['pwrd'];
	    $pwd = sha1($pwd);
	}
	if (isset($name) && isset($pwd)){
	    $sql = $dbcon->query("
		SELECT `userID`, `slug`
		FROM res_user
		WHERE username='". $dbcon->real_escape_string($name) ."'
		AND password='". $dbcon->real_escape_string($pwd) ."'
	    ");
	    if ($sql ||  $sql->num_rows != 0){

		session_start();

		while($row = $sql->fetch_object()){
		    $userID = $row->userID;
		    $slug = $row->slug;
		}
		$_SESSION['user'] = $userID;
		$_SESSION['slug'] = substr(md5($slug), 0, 6);
	    }
	    else {
		header( "Location: ".$uriPath."admin/login.php?e=3");
	    }
	}
    }
    else {
	header( "Location: ".$uriPath."admin/login.php");
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
