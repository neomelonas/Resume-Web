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
		echo "<li><a href='" . $uriPath . "resume/" . $userID . "/' title='". $clicks ." Views'>" . $userName 
. "</a>  <span class='canhide'>". $clicks ." Views</span></li>";//" . $uriPath . "
	}
}



///////////////////////////
///   For The Resumes   ///
///////////////////////////
function GetUserInfo($userInfo) {
	$userID = $userInfo['ID'];
	//$userInfo['name'] = GetUserName($userID);
	echo "<h1>";GetUserName($userID); echo "</h1>";
	GetContactInfo($userInfo);
}
function GetContactInfo($userInfo) {
	GetUserLocation($userInfo);
	if (isset($userInfo['hAddress']))
	{ echo $userInfo['hAddress']; }
	if (isset($userInfo['lAddress']))
	{ echo $userInfo['lAddress']; }
	GetUserPhone($userInfo);
	echo "&bull;";
	GetUserEmail($userInfo);
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
function GetUserLocation($userInfo) {
	$userID = $userInfo['ID'];
	$sql = mysql_query("SELECT L.locID, locStreet, locStreet2, locCity ,locState, locZIP, homeLoc FROM resume_dev2.res_location L INNER JOIN res_user_loc UL ON L.locID=UL.locID WHERE userID='" . $userID . "'");
	while($row = mysql_fetch_object($sql)) {
		$homeLoc = null;
		if (ord($row->homeLoc) == 1)
		{ $homeLoc = $row->locID; }
		else
		{ $localLoc = $row->locID; }
		$street = $row->locStreet;
		$city = $row->locCity;
		$state = $row->locState;
		$ZIP = $row->locZIP;
		if (isset($locStreet2)) {
			$street = $street . " " . $row->locStreet2;
		}
		$address = $street . " " . $city . ", " . $state . " " . $ZIP;
		if (isset($homeLoc)) 
		{
			$userInfo['hAddress'] = "<h4><span class='home address'>HOME: " . $address . "</span></h4>";
			echo $userInfo['hAddress'];
		}
		else 
		{
			$userInfo['lAddress'] = "<h4><span class='local address'>LOCAL: " . $address . "</span></h4>";
			echo $userInfo['lAddress'];
		}
	}
}
function GetUserPhone($userInfo) {
	$userID = $userInfo['ID'];
	$sql = mysql_query("SELECT phArea, phZone, phLocal, phType from res_phone where userID='" . $userID . "' and prefPhone='1' LIMIT 1");
	while($row = mysql_fetch_object($sql)) {
		$phone = "(" . $row->phArea . ") " . $row->phZone . "-" . $row->phLocal;
		$userInfo['phone'] = $phone;
		$userInfo['phType'] = $row->phType;
		echo "<h4><span class='phone'>" . $userInfo['phone'] . "</span>";
	}	
}
function GetUserEmail($userInfo) {
	$userID = $userInfo[ID];
	$sql = mysql_query("SELECT userEmail from res_user where userID='" . $userID . "' LIMIT 1");
	while($row = mysql_fetch_object($sql)) {
		$userInfo[email] = $row->userEmail;
		echo "<span class='email'><a href='mailto:" . $userInfo[email] . "'>" . $userInfo[email] . "</a></span></h4>";
	}
}

function GetUserEd($userInfo) {
	$userID = $userInfor[ID];
	
	$edSQL = mysql_query("SELECT ed.edID, edName, edCity, edState, edStart, edEnd FROM res_user_ed ued INNER JOIN res_education ed on ued.edID=ed.edID WHERE  userID='" . $userID . "'");
	while($row = mysql_fetch_object($edSQL)) {
		$edID = $row->edID;
		$edName = $row->edName;
		$edCity = $row->edCity;
		$edState = $row->edState;
		$edStart = $row->edStart;
		if (!isset($row->edEnd))
		{ $edEnd = "Present"; }
		else
		{ $edEnd = $row->edEnd; }
		$colSQL = mysql_query("SELECT C.colID, colName, gradMonth, gradYear from resume_dev2.res_user_col UC INNER JOIN resume_dev2.res_ed_col C on UC.colID=C.colID WHERE userID='" . $userID . "' AND C.edID='" . $edID . "'");
		while($lines = mysql_fetch_object($colSQL)) {
			$colID = $lines->colID;
			$colName = $lines->colName;
			if (isset($lines->gradMonth)) 
			{ $gradMonth = $lines->gradMonth; }
			$gradYear = $lines->gradYear;
			$degSQL = mysql_query("SELECT D.degreeID, degreeName, gpa FROM resume_dev2.res_ed_degree D INNER JOIN  resume_dev2.res_user_deg UD on D.degreeID=UD.degreeID INNER JOIN resume_dev2.res_user_gpa UG on D.degreeID=UG.degreeID WHERE userID='" . $userID . "' and colID='" . $colID . "'");
			while($paths = mysql_fetch_object($degSQL)) {
				$degreeID = $paths->degreeID;
				$degreeName = $paths->degreeName;
				$gpa = $paths->gpa;
				echo $gpa;
			}
		}
	}

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
				echo "<li><a href='/ResumeBeta/resume/". $userID . "/'>" . $username ."</a></li>";
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
				echo "<li><a href='/ResumeBeta/resume/" . $userID . "/>" . $username . "</a></li>";
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
				echo "<li><a href='/ResumeBeta/resume/" . $userID . "'>" . $username . "</a></li>";
			}
		}
	}
}


//////////////////////////
///   For   Admining   ///
//////////////////////////

function userLogin($userEmail, $password) {

}

//////////////////////////
///   For	UserInfo   ///
//////////////////////////
function FillUserInfo($userInfo) {
	$userID = $userInfo[ID];
	
	$sql = mysql_query("SELECT userFName, userMName, userLName, middleASnick, userEmail from resume_dev2.res_user where userID=" . $userID . " LIMIT 1");
	while($row = mysql_fetch_object($sql)) {
		if (isset ($row->userMName))
		{ $umname = $row->userMName; }
		if (($row->middleASnick) && (isset($umname)))
		{ $umname = '"'.$umname.'"'; }
		$ufname = $row->userFName;
		$ulname = $row->userLName;
		$userInfo[email] = $row->userEmail;
	}
	if (isset($umname))
	{ $uName = $ufname . " " .$umname . " " . $ulname;}
	else
	{ $uName = $ufname . " " . $ulname; }
	$userInfo[name] = $uName;
	$GETsql = mysql_query('SELECT clickCount FROM resume_dev2.res_data_user WHERE userID="'. $userID .'" LIMIT 
1');
	while($row = mysql_fetch_object($GETsql)) {
		$userInfo[views] = $row->clickCount;
	}
	$sql = mysql_query("SELECT L.locID, locStreet, locStreet2, locCity ,locState, locZIP, homeLoc FROM resume_dev2.res_location L INNER JOIN res_user_loc UL ON L.locID=UL.locID WHERE userID='" . $userID . "'");
	while($row = mysql_fetch_object($sql)) {
		$homeLoc = null;
		if (ord($row->homeLoc) == 1)
		{ $homeLoc = $row->locID; }
		else
		{ $localLoc = $row->locID; }
		$street = $row->locStreet;
		$city = $row->locCity;
		$state = $row->locState;
		$ZIP = $row->locZIP;
		if (isset($locStreet2)) {
			$street = $street . " " . $row->locStreet2;
		}
		$address = $street . " " . $city . ", " . $state . " " . $ZIP;
		if (isset($homeLoc)) 
		{ $userInfo['hAddress'] = $address; }
		else 
		{ $userInfo['lAddress'] = $address; }
	}
	
	$sql = mysql_query("SELECT phArea, phZone, phLocal, phType from res_phone where userID='" . $userID . "' and prefPhone='1' LIMIT 1");
	while($row = mysql_fetch_object($sql)) {
		$phone = "(" . $row->phArea . ") " . $row->phZone . "-" . $row->phLocal;
		$userInfo['phone'] = $phone;
		$userInfo['phType'] = $row->phType;
	}
	print_r($userInfo);
}
?>
