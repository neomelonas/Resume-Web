<?php 
include 'lib/conf/settings.inc';
$url = $_SERVER['HTTP_REFERER'];
if (!isset($_GET['u']))
{
	header("Location: $url");
}
else
{
	$userID = $_GET['u'];
	mysql_select_db($db, $con);
	mysql_query("update res_data_user set clickCount=0 where userID='" . $userID . "'") or die('NO GO');
	mysql_close($con);
	header("Location: $url");
}
?>
