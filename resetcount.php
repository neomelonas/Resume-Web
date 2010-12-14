<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */

/**  Loads the settings, currently for db connections. */
include ('conf/settings.php');
$url = $_SERVER['HTTP_REFERER'];
if (!isset($_GET['u']))
{
	header("Location: $url");
}
else
{
	$userID = $_GET['u'];
	mysqli_query($dbcon,"update res_data_user set clickCount=0 where userID='" . $userID . "'") or die('NO GO');
	mysqli_close($dbcon);
	header("Location: $url");
}
?>
