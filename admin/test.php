<?php
require_once 'D:\Server\xampp\htdocs\ResumeBeta\conf\settings.php';
require_once 'D:\Server\xampp\htdocs\ResumeBeta\admin\lib\class\AdminUser.php';
$admin = new AdminUser($dbcon);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>test</title>
	<link type="text/css" rel="stylesheet" href="test.css">
    </head>
    <body>

	    <?php
//		$fname = "Test";
//		$mname = "Y";
//		$lname = "McTesterson";
//		$email = "test@test.org";
//		$mAn = "false";
//		$phone = "203-444-3210";
//		$uname = "testerz";
//		$theme = "elegant";
//		$statement = "null";
//		$objective = "false";
		//$uID = $admin->addNewUser($dbcon,$fname,$mname,$lname,$email,$mAn,$phone,$uname,$theme,$statement,$objective);
		//echo $uID;
		$admin->displayTechForm($dbcon);
	    ?>
    </body>
</html>
