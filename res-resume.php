<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 /**
 * This page displays resumes!  WHICH IS AWESOME, promise.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.1.0
 * @since v3.0.0
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
    $local = new Location($dbname,0,$resuser->getUserID(),$dbcon);
    $education = new Education($dbcon,$resuser->getUserID());
    $tech = new Skills($dbcon,$resuser->getUserID(),$resuser->getUserInfo('techType'));
    $course = new Course($dbcon, $resuser->getUserID());
    $experience = new ExpDetail($dbcon,$resuser->getUserID());
    $intact = new IntAct($dbcon,$resuser->getUserID());
}
else {die ('User Does Not Exist'); }

if ($resuser->getUserInfo('theme') != null){
    if (file_exists($absPath."res-theme/".$resuser->getUserInfo('theme')."/index.php")){
	include ($absPath."res-theme/".$resuser->getUserInfo('theme')."/index.php");
    }
    else {
	include ($absPath."res-theme/elegant/index.php");
    }
}
else {
    include ($absPath."res-theme/elegant/index.php");
}
?>
