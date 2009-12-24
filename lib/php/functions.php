<?php
function db_connect($con) {
	if (!$con)
	{ die('Could not connect: ' . mysql_error()); }
	else
	{ mysql_select_db($db, $con); }
}
function mostSearched() {
	$determineMostSearched = mysql_query("select searchedID, count(searchedID) as Stats from res_data_user group by searchedID order by Stats desc LIMIT 5");
	while($row = mysql_fetch_array($determineMostSearched))
	{
		$userID = $row['searchedID'];
		$countID = $row['Stats'];
		$mostSearchedSQL = mysql_query("select userFName, userLName from res_user where userID=$userID");
		while($line = mysql_fetch_array($mostSearchedSQL))
		{
			$ufname = $line['userFName'];
			$ulname = $line['userLName'];
			$userName = $ufname . " " . $ulname;
			echo "<li>" . $userName . "</li>";
		}
	}
}

function recentChanges() {
	$datetime = date("y-m-d H:i:s",time());	
}

function GetUserData() {
	$sql = mysql_query(' ');
}

function mostViewed()
{
	$AmostViewed = array();
	$sql = mysql_query("SELECT U.userID, U.userFName, U.userLName FROM resume_dev2.res_user U INNER JOIN resume_dev2.res_data_user DU on U.userID=DU.userID ORDER BY DU.lastUpdate DESC LIMIT 5");
	while($row = mysql_fetch_object($sql))
	{
		$userID = $row->userID;
		$userName = $row->userFName . " " . $row->userLName;
		//$AmostViewed[$userID] = $userName;
		
		echo "<li><a href='/ResumeBeta/resume/" . $userID . "'>" . $userName . "</a></li>";//" . $uriPath . "

	}
}

function grabResumeData($userID) {}

function GetUserName($userID) {
	
}
?>