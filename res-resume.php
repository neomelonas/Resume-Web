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
    include_once (absPath."lib/class/{$class}.php");
}

if (isset($_GET['u']))
{ $userID = $_GET['u']; }
if (isset($_GET['n'])){
    $sql = $dbcon->query("SELECT userID FROM res_user WHERE slug='".$_GET['n']."'");
    while($row = $sql->fetch_object()){
	$userID = $row->userID;
    }
}
$r = (object) array();
if (isset($userID)) {
    /** @TODO remove these & fix compatibility issues. */
    $resuser = new User($userID,$dbname,$dbcon);
    $home = new Location($dbname,1,$resuser->getUserID(),$dbcon);
    $local = new Location($dbname,0,$resuser->getUserID(),$dbcon);
    $education = new Education($dbcon,$resuser->getUserID());
    $tech = new Skills($dbcon,$resuser->getUserID(),$resuser->getUserInfo('techType'));
    $course = new Course($dbcon, $resuser->getUserID());
    $experience = new ExpDetail($dbcon,$resuser->getUserID());
    $intact = new IntAct($dbcon,$resuser->getUserID());
    /** @TODO Update these AFTER fixing compatibility issues. (AND DOCUMENT STUFF) */
    $r->resuser = $resuser;
    $r->home = $home;
    $r->local = $local;
    $r->education = $education;
    $r->tech = $tech;
    $r->course = $course;
    $r->experience = $experience;
    $r->intact = $intact;
}
else { die ('User Does Not Exist'); }/** @TODO: Make better error handling, here. */

$theme = !is_null($resuser->getUserInfo('theme')) ? $r->resuser->getUserInfo('theme') : 'elegant';
if (file_exists(absPath."res-theme/$theme/functions.php")) include_once (absPath."res-theme/$theme/functions.php");
?><!doctype html>
<html>
    <head>
        <?php function_exists(theheader) ? theheader($r) : include_once (absPath."res-theme/$theme/header.php"); ?>
    </head>
    <body>
    <?php
        function_exists(afterheader) ? afterheader($r) : include_once (absPath."res-theme/$theme/afterheader.php");
        function_exists(thebody) ? thebody($r) : include_once (absPath."res-theme/$theme/body.php");
        function_exists(thefooter) ? thefooter($r) : include_once (absPath."res-theme/$theme/footer.php");
    ?>
    </body>
</html>
