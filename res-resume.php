<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 /**
 * This page displays resumes!  WHICH IS AWESOME, promise.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version 3.5.0
 * @since 3.0.0
 * @copyright 2009-2010 Neo Melonas
 */

/**  Loads the settings, currently for db connections. */
include ('conf/settings.php');

/**
 * Auto-loads all of the class files.
 * @param string $loadable guesses the name of the class files.
 */
function __autoload($class) {
    include_once ($uriPath."lib/class/{$class}.php");
}

if (isset($_GET['u']))
{ $userID = $_GET['u']; }
if (isset($_GET['n'])){
    $sql = $dbcon->query("SELECT userID FROM res_user WHERE slug='".$_GET['n']."'");
    while($row = $sql->fetch_object()){
	$userID = $row->userID;
    }
}

if (isset($userID)) {
    $resuser = new User($userID,$dbname,$dbcon);
    $home = new Location($dbname,1,$resuser->getUserID(),$dbcon);
<<<<<<< HEAD
    $loc = new Location($dbname,0,$resuser->getUserID(),$dbcon);
    $te = new Technology($dbcon,$resuser->getUserID(),$restype);
    $ia = new IntAct($dbcon,$resuser->getUserID());
    $ed = new Education($dbcon,$resuser->getUserID());
    $exp = new ExpDetail($dbcon,$resuser->getUserID());
=======
    $local = new Location($dbname,0,$resuser->getUserID(),$dbcon);
    $education = new Education($dbcon,$resuser->getUserID());
    $tech = new Skills($dbcon,$resuser->getUserID(),$resuser->getUserInfo('techType'));
>>>>>>> admin
    $course = new Course($dbcon, $resuser->getUserID());
    $experience = new ExpDetail($dbcon,$resuser->getUserID());
    $intact = new IntAct($dbcon,$resuser->getUserID());
}
else { die ('User Does Not Exist'); }

if ($resuser->getUserInfo('theme') != null){
    if (file_exists($absPath."res-theme/".$resuser->getUserInfo('theme')."/header.php")
	&& file_exists($absPath."res-theme/".$resuser->getUserInfo('theme')."/body.php")
	&& file_exists($absPath."res-theme/".$resuser->getUserInfo('theme')."/footer.php")
	){
	?>
	<!doctype html>
	<html>
	    <head>
		<?php include ($absPath."res-theme/".$resuser->getUserInfo('theme')."/header.php"); ?>
	    </head>
	    <body>
		<?php include ($absPath."res-theme/".$resuser->getUserInfo('theme')."/body.php"); ?>
		<?php include ($absPath."res-theme/".$resuser->getUserInfo('theme')."/footer.php"); ?>
	    </body>
	</html>
	<?php
    }
    else if (file_exists($absPath."res-theme/".$resuser->getUserInfo('theme')."/index.php")){
	include ($absPath."res-theme/".$resuser->getUserInfo('theme')."/index.php");
    }
    else {
	?>
	<!doctype html>
	<html>
	    <head>
		<?php include ($absPath."res-theme/elegant/header.php"); ?>
	    </head>
	    <body>
		<?php include ($absPath."res-theme/elegant/body.php"); ?>
		<?php include ($absPath."res-theme/elegant/footer.php"); ?>
	    </body>
	</html>
	<?php
    }
}
else {
    ?>
    <!doctype html>
    <html>
	<head>
	    <?php include ($absPath."res-theme/elegant/header.php"); ?>
	</head>
	<body>
	    <?php include ($absPath."res-theme/elegant/body.php"); ?>
	    <?php include ($absPath."res-theme/elegant/footer.php"); ?>
	</body>
    </html>
    <?php
}
?>
