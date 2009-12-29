<?php
$userPrefs = array();
function db_connect($con) {
	if (!$con)
	{ die('Could not connect: ' . mysql_error()); }
	else
	{ mysql_select_db($db, $con); }
}


/////////////////////////
///   For the Index   ///
/////////////////////////


function mostSearched() {
	$MostSearchedSQL = mysql_query("");
	while($row = mysql_fetch_array($MostSearchedSQL))
	{
		
	}
}



function recentChanges() {
	$datetime = date("y-m-d H:i:s",time());	
}

function AnotherPageView($userID) {
	$GETsql = mysql_query('SELECT clickCount FROM resume_dev2.res_data_user WHERE userID="'. $userID .'" LIMIT 1');
	while($row = mysql_fetch_object($GETsql)) {
		
		$clickCount = $row->clickCount;
		$clickCount++;
		
		$SETsql = mysql_query('UPDATE resume_dev2.res_data_user SET clickCount='. $clickCount .' WHERE userID='. $userID .'');
		mysql_db_query(resume_dev2, $SETsql);
	}
	 echo "<!-- " . $clickCount . " /-->";
}
function featured($uriPath) {
	$sql = mysql_query("SELECT U.userID, userFName, userLName, DU.clickCount FROM resume_dev2.res_user U INNER JOIN resume_dev2.res_data_user DU on U.userID=DU.userID WHERE featured=1 ORDER BY DU.clickCount DESC LIMIT 5");
	while($row = mysql_fetch_object($sql)) {
		$userID = $row->userID;
		$userName = $row->userFName . " " . $row->userLName;
		echo "<li><a href='" . $uriPath . "resume/" . $userID . "/'>" . $userName . "</a></li>";
	}
}
function recentUpdate($uriPath) {
	$sql = mysql_query("SELECT U.userID, userFName, userLName FROM resume_dev2.res_user U INNER JOIN resume_dev2.res_data_user DU on U.userID=DU.userID ORDER BY DU.lastUpdate DESC LIMIT 5");
	while($row = mysql_fetch_object($sql)) {
		$userID = $row->userID;
		$userName = $row->userFName . " " . $row->userLName;
		echo "<li><a href='" . $uriPath . "resume/" . $userID . "/'>" . $userName . "</a></li>";
	}
}
function recentAddition($uriPath) {
	$sql = mysql_query("SELECT U.userID, userFName, userLName FROM resume_dev2.res_user U INNER JOIN resume_dev2.res_data_user DU on U.userID=DU.userID ORDER BY DU.dateCreated DESC LIMIT 5");
	while($row = mysql_fetch_object($sql)) {
		$userID = $row->userID;
		$userName = $row->userFName . " " . $row->userLName;
		echo "<li><a href='" . $uriPath . "resume/" . $userID . "/'>" . $userName . "</a></li>";
	}
}
function mostViewed($uriPath) {
	$sql = mysql_query("SELECT U.userID, userFName, userLName, DU.clickCount FROM resume_dev2.res_user U INNER JOIN resume_dev2.res_data_user DU on U.userID=DU.userID ORDER BY DU.clickCount DESC LIMIT 5");
	while($row = mysql_fetch_object($sql))
	{
		$userID = $row->userID;
		$userName = $row->userFName . " " . $row->userLName;
		$clicks = $row->clickCount;
		echo "<li><a href='" . $uriPath . "resume/" . $userID . "/' title='". $clicks ." Views'>" . 
$userName . "</a>  <span 
class='canhide'>". $clicks ." Views</span></li>";//" . $uriPath . "
	}
}



///////////////////////////
///   For The Resumes   ///
///////////////////////////


function GetUserLocation($userID) {
	$sql = mysql_query("SELECT L.locID, locStreet, locStreet2, locCity ,locState, locZIP, homeLoc FROM resume_dev2.res_location L INNER JOIN res_user_loc UL ON L.locID=UL.locID WHERE userID='" . $userID . "'");
	while($row = mysql_fetch_object($sql)) {
		if (ord($row->homeLoc) == 1)
		{ $homeLoc = $row->locID; }
		else
		{ $localLoc = $row->locID; }
		
	}
}

function GetUserEd($userID) {
	$edSQL = mysql_query("SELECT edID, edStart, edEnd from resume_dev2.res_user_ed where userID='" . $userID . "'");
}
function GetUserSpecificEd($userID) {
	$colSQL = mysql_query("SELECT colID, gradMonth, gradYear from resume_dev2.res_user_col where userID='" . $userID . "'");
		$degSQL = mysql_query("SELECT degreeID from resume_dev2.res_user_deg where userID='" . $userID . "' and colID='" . $colID . "'");
			$gpaSQL = mysql_query("SELECT gpa from resume_dev2.res_user_gpa where userID='" . $userID . "' and degreeID = '" . $degreeID . "'");
		$majSQL = mysql_query("SELECT majorID from resume_dev2.res_user_major where userID='" . $userID . "' and colID='" . $colID . "'");
}	
function GetUserMinor($userID) {
	$minSQL = mysql_query("SELECT minorID from resume_dev2.res_user_minor where userID='" . $userID . "'");
}
function GetUserTech($userID) {	
	$techSQL = mysql_query("SELECT teID from resume_dev2.res_user_tech where userID='" . $userID . "'");
}
function GetUserRC($userID) {
	$rcSQL = mysql_query("SELECT rcID from resume_dev2.res_user_rc where userID='" . $userID . "'");
}
function GetUserExpPosition($userID) {
	$expSQL = mysql_query("SELECT expID, expPosition, expStartMonth, expStartYear, expEndMonth, expEndYear from resume_dev2.res_user_ia where userID='" . $userID . "'");
}
function GetUserIA($userID) {
	$iaSQL = mysql_query("SELECT iaID, iaWeight from resume_dev2.res_user_id where userID='" . $userID . "'");
}
function GetUserName($userID) {
	$sql = mysql_query("SELECT userFName, userMName, userLName, middleASnick from resume_dev2.res_user where userID=" . $userID . " LIMIT 1");
	while($row = mysql_fetch_object($sql)) {
		if (isset ($row->userMName))
		{ $umname = $row->userMName; }
		if (($row->middleASnick) && (isset($umname)))
		{ $umname = '"'.$umname.'"'; }
		$ufname = $row->userFName;
		$ulname = $row->userLName;
	}
	if (isset($umname))
	{ $uName = $ufname . " " .$umname . " " . $ulname;}
	else
	{ $uName = $ufname . " " . $ulname; }
	echo $uName;
}
function UserLocation($userID) {
	GetUserLocation($userID);
	$location = array();
	$homeSQL = mysql_query("SELECT locStreet, locStreet2, locCity ,locState, locZIP from resume_dev2.res_location where locID='". $homeLoc ."'");
	if (isset($localLoc)) {
		$localSQL = mysql_query("SELECT locStreet, locStreet2, locCity ,locState, locZIP from resume_dev2.res_location where locID=". $localLoc ."");
		while($line = mysql_fetch_object($localSQL)) {
		}
	}
	while($row = mysql_fetch_object($homeSQL)) {
		$location[street] = $row->locStreet;
		if (isset($row->locStreet2))
		{ $location[street2] = $row->locStreet2; }
		$location[city] = $row->locCity;
	}
	echo $location[city];
	//$userPrefs['hloc'];
}


//////////////////////////
///   For   Browsing   ///
//////////////////////////

function browsing($browse) {
	if ($browse == 'name') {
		$letter = "A";
		for ($counter = 1; $counter <= 26; $counter++) {
			echo "<h4><a id=". $letter .">". $letter ."</a></h4><ul id='browsename'>";
			$sql = mysql_query("SELECT userID, userFName, userLName FROM resume_dev2.res_user WHERE `userLName` LIKE '". $letter ."%' ORDER BY userLName ASC;");
			while($row = mysql_fetch_object($sql)) {
				$userID = $row->userID;
				$ufname = $row->userFName;
				$ulname = $row->userLName;
				$username = $ufname . " " . $ulname;
				echo "<li><a href=''" . $uriPath . "resume/". $userID . "/'>" . $username 
."</a></li>";
			}
			$letter++;
			echo "</ul>";
		}
	}
	if ($browse == 'major') {
		$sql = mysql_query("SELECT majorID, majorName FROM resume_dev2.res_ed_major");
		while($row = mysql_fetch_object($sql)) {
			$majorID = $row->majorID;
			$majorName = $row->majorName;
			echo "<h4>" . $majorName .", ". $majorID . "</h4><ul>";
			$moreSQL = ("SELECT `U.userID`, `U.userFName`, `U.userLName` FROM resume_dev2.res_user U INNER JOIN resume_dev2.res_user_major UM on U.userID=UM.userID where UM.majorID=" . $row->majorID . "");
			while($lines = mysql_fetch_array($moreSQL)) {
				echo $row['majorName'];
				$userID = $lines['userID'];
				$ufname = $lines['userFName'];
				$ulname = $lines['userLName'];
				$username = $ufname . " " . $ulname;
				echo "<li><a href='" . $uriPath . "resume/" . $userID . "/>" . $username . 
"</a></li>";
			}
			echo "</ul>";
		}
		
	}
	if ($browse == 'year') {
		$finding = mysql_query("select distinct `gradYear` from resume_dev2.res_user_col order by gradYear DESC");
		while($rows = mysql_fetch_object($finding)) {
			$year = $rows->gradYear;
			echo "<h4>".$year."</h4>";
			$sql = mysql_query("SELECT U.userID, userFName, userLName FROM res_user U INNER JOIN res_user_col UC on U.userID=UC.userID WHERE gradYear='". $rows->year ."'");
			while($row = mysql_fetch_object($sql)) {
				$userID = $row->userID;
				$ufname = $row->userFName;
				$ulname = $row->userLName;
				$username = $ufname . " " . $ulname;
				echo "<li><a href='" . $uriPath . "resume/" . $userID . "'>" . $username . 
"</a></li>";
			}
		}
	}
}


//////////////////////////
///   For   Admining   ///
//////////////////////////

function userLogin($userID, $password) {
	
}

?>
