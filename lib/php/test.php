<?php

require 'settings.php';
include 'class.db.php';
include 'class.user.php';

$resuser = new user($userID);
$sql = mysql_query("SELECT `userFName`, `userMName`, `userLName`, `middleASnick`, `userEmail`, `password` FROM res_user WHERE userID='" . $userID . "'");
while($row = mysql_fetch_object($sql)) {
	$resuser->setUserFName($row->userFName);
	$resuser->setUserMName($row->userMName);
	$resuser->setUserLName($row->userLName);
	$resuser->setMaN($row->middleASnick);
	$resuser->setUserEmail($row->userEmail);
	$resuser->setUserPassword($row->password);
}
$resuser->userFullName();
echo $userName;

?>
