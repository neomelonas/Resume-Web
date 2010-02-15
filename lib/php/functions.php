<?php
<<<<<<< HEAD
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 /**
  * This entire file is
  * @deprecated
  */



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
=======

$con = mysql_connect($host,$name,$pwd);

$localAd	= false;
$homeAd		= false;

function getUserID($userTag)
{
	if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
	else
	{
		mysql_select_db($db, $con);
		$userTagSQL = mysql_query('select userID from resume_dev.res_user where userTag="' . $userTag . '"');
		while($row = mysql_fetch_object($userTagSQL))
		{ $userID = $row->userID; }
	}
}

function getUserPrefs($userID)
{
	$prefSQL = mysql_query("select middleISnick, preferredPH, showGPA, defaultResumeType, preferredGPA from resume_dev.res_user_pref where userID='".$userID."'");
	while($row = mysql_fetch_array($prefSQL))
	{
		$mISn 	= $row['middleISnick'];
		$prefPH	= $row['preferredPH'];
		$showGPA	= $row['showGPA'];
		$resType	= $row['defaultResumeType'];
		$prefGPA	= $row['preferredGPA'];
>>>>>>> cce638a96bbdf0cfe02d97b6685f4200ab6004d6
	}
}


<<<<<<< HEAD

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
function GetUserEducation($userInfo) {
	$userID = $userInfo[ID];
	$education = array();
	$major = array();
	$sql = mysql_query("SELECT ed.edID, col.colID, `edName`, `edCity`, `edState`, `edStart`, `edEnd`, `colName`, `gradMonth`, `gradYear`, `degreeName` FROM resume_dev2.res_education ed INNER JOIN res_user_col ucol on ed.edID=ucol.edID INNER JOIN res_ed_col col on ucol.colID=col.colID INNER JOIN res_ed_degree deg on ucol.degreeID=deg.degreeID WHERE userID='" . $userID . "'");
	while($row = mysql_fetch_object($sql)) {
		$education[ID] = $row->edID;
		$education[edName] = $row->edName;
		$education[city] = $row->edCity;
		$education[state] = $row->edState;
		$education[edStart] = $row->edStart;
		if (isset($row->edEnd))
		{ $education[edEnd] = $row->edEnd; }
		else
		{ $education[edEnd] = 'Present'; }
		$education[colID] = $row->colID;
		$education[colName] = $row->colName;
		if (isset($row->gradMonth))
		{ $education[gradMonth] = $row->gradMonth; }
		else
		{ $education[gradMonth] = ''; }
		$education[gradYear] = $row->gradYear;
		$education[degree] = $row->degreeName;
		
		$edDisplay = "<section id='ed-" . $education[ID] . "'><section class='span-7 column'><ul><li class='school'>" . $education[edName] . "</li><li class='college col-" . $education[colID] . "'>" . $education[colName] . "</li><li class='degree'>" . $education[degree] . "</li>";
		$sql2 = mysql_query("SELECT maj.majorID, maj.majorName, umaj.gpa FROM res_ed_col col INNER JOIN res_user_major umaj on col.colID=umaj.colID INNER JOIN res_ed_major maj on umaj.majorID=maj.majorID WHERE userID='" . $userID . "' AND colID='" . $education[colID] . "'");
		//$major[count] = mysql_num_rows($sql2);
		//if ($major[count] > '1')
		//{ $edDisplay += "<ul class='" . $major[count] . "majors multimajor'>"; }
		while($line = mysql_fetch_object($sql2)) {
			$major[ID] = $line->majorID;
			$major[name] = $line->majorName;
			if (isset($line->gpa)) { $education[major] = $line->majorName; $education[gpa] = $line->gpa; }
			
			$edDisplay += "<li class='major ma-" . $major[ID] . "'>" . $major[name] . "</li>";
		}
		//if ($major[count] > '1') { $edDisplay += "</ul>"; }
		GetUserMinor($userInfo);
		$edDisplay += "</ul></section><section class='prepend-2 span-5 column'><ul><li class='location'>" . $education[city] . ", " . $education[state]. "</li></ul></section><section class='prepend-3 span-4 column last'><ul>	<li class='range'>" . $education[edStart] . " &ndash; " . $education[edEnd] . "</li><li class='grad'><span class='graduation'>Graduation: </span>" . $education[gradMonth] . " " . $education[gradYear] . "</li><li class='blank'></li><li class='gpa'>";
		if (isset($education[major])) { $edDisplay += $education[major] . " "; }
		if (isset($education[gpa])) 
		{ $edDisplay += "GPA: " . $education[gpa]; }
		$edDisplay += "</li></section></section>";
	}
}
function GetUserMinor($userID) {
	$sql = mysql_query("SELECT min.minorID, `minorName` FROM res_ed_minor min INNER JOIN res_user_minor umin on min.minorID=umin.minorID WHERE userID='" . $userID . "'");
	$minor[count] = mysql_num_rows($sql);
	if ($minor[count] > '1')
	{ $edDisplay += "<ul class='" . $minor[count] . "minors multiminor'>"; }
	while($row = mysql_fetch_object($sql)) {
		if (isset($row->minorName)) { $edDisplay += "<li class='minor minor-" . $row->minorID . ">" . $row->minorName . "</li>"; }
	}
	if ($minor[count] > '1')
	{ $edDisplay += "</ul>";}
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
			$moreSQL = ("SELECT U.userID, `userFName`, `userLName` FROM res_user U INNER JOIN res_user_major UM on U.userID=UM.userID where UM.majorID=" . $majorID . "");
			while($lines = mysql_fetch_object($moreSQL)) {
				$userID = $lines->userID;
				$ufname = $lines->userFName;
				$ulname = $lines->userLName;
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
=======
function populateName($con, $userID)
{
	$nameSQL = mysql_query("select userFName, userMName, userLName from resume_dev.res_user where userID='".$userID."'");
	while($row = mysql_fetch_array($nameSQL))
	{
		$userFName	= $row['userFName'];
		$userMName	= $row['userMName'];
		$userLName	= $row['userLName'];

		$prefSQL = mysql_query("select middleISnick from resume_dev.res_user_pref where userID='".$userID."'");
		while($row = mysql_fetch_array($prefSQL))
		{
			$mISn 	= $row['middleISnick'];
			//Create User's Name
			if ($userMName != NULL)
			{
				if ($mISn != true)
				{ $userName = $userFName." ".$userMName." ".$userLName; }
				else
				{ $userName = $userFName." \"".$userMName."\" ".$userLName; }
			}
			else
			{ $userName = $userFName." ".$userLName; }
		}
		echo $userName;
	}
}


function metaDescription($userID)
{
	echo '"';
	$metaDescSQL = mysql_query('select metaDesc from res_meta_desc where userID="'. $userID .'"');
	while($row = mysql_fetch_array($metaDescSQL))
	{ echo $row['metaDesc']; }	
	echo '"';
}

function metaKeywords($userID)
{
	echo '"';
	$metaKeyWordsSQL = mysql_query('select metaWord from res_meta_keywords where userID="'. $userID .'"');
	while($row = mysql_fetch_array($metaKeyWordsSQL))
	{
		echo $row['metaWord'].', ';
	}
	echo 'created by Neo Melonas"';
}

function populateHeader($userID)
{
	$sql1 = mysql_query("select userFName, userMName, userLName, userEmail, locLID, locHID from resume_dev.res_user where userID='".$userID."'");

	while($row = mysql_fetch_array($sql1))
	{
		$userFName	= $row['userFName'];
		$userMName	= $row['userMName'];
		$userLName	= $row['userLName'];
		$userEmail	= $row['userEmail'];
		$localID 	= $row['locLID'];
		$homeID		= $row['locHID'];
		
		$prefSQL = mysql_query("select middleISnick, preferredPH from resume_dev.res_user_pref where userID='".$userID."'");
		while($row = mysql_fetch_array($prefSQL))
		{
			$mISn 		= $row['middleISnick'];
			$phoneID	= $row['preferredPH'];
			
			//Create User's Name
			if ($userMName != NULL)
			{
				if ($mISn != true)
				{ $userName 	= $userFName." ".$userMName." ".$userLName; }
				else
				{ $userName 	= $userFName." \"".$userMName."\" ".$userLName; }
			}				
			else
			{ $userName 	= $userFName." ".$userLName; }
			
			
			if ($localID != NULL)
			{
				$localAd = true;
				$localSQL = mysql_query("select locStreet1, locStreet2, locCity, locState, locZIP from resume_dev.res_loc where locID = '".$localID."'");
				while($row = mysql_fetch_array($localSQL))
				{
					$localS1	= $row['locStreet1'];
					$localS2	= $row['locStreet2'];
					$localCity	= $row['locCity'];
					$localState	= $row['locState'];
					$localZIP	= $row['locZIP'];
					
					//Create Local Address
					if ($localAd == true && $localS2 != NULL)
					{
						$localAddress	= "Local:  ".$localS1.", ".$localS2."&nbsp;&#8226;&nbsp;".$localCity.", ".$localState." ".$localZIP;
					}
					elseif ($localAd == true && $localS2 == NULL)
					{
						$localAddress	= "Local:  ".$localS1."&nbsp;&#8226;&nbsp;".$localCity.", ".$localState." ".$localZIP;
					}
				}
			}
			else
			{ $localAd = false; }

			
			if ($homeID != NULL)
			{
				$homeAd = true;
				$homeSQL = mysql_query("select locStreet1, locStreet2, locCity, locState, locZIP from resume_dev.res_loc where locID = '".$homeID."'");
				while($row = mysql_fetch_array($homeSQL))
				{
					$homeS1		= $row['locStreet1'];
					$homeS2		= $row['locStreet2'];
					$homeCity	= $row['locCity'];
					$homeState	= $row['locState'];
					$homeZIP	= $row['locZIP'];
					
					//Create Home Address
					if ($homeAd == true && $homeS2 != NULL)
					{
						$homeAddress	= "Home:  ".$homeS1.", ".$homeS2."&nbsp;&#8226;&nbsp;".$homeCity.", ".$homeState." ".$homeZIP;
					}
					elseif ($homeAd == true && $homeS2 == NULL)
					{
						$homeAddress	= "Home:  ".$homeS1."&nbsp;&#8226;&nbsp;".$homeCity.", ".$homeState." ".$homeZIP;
					}
					
				}
			}
			else
			{ $homeAd = false; }
			
			
			$phoneSQL = mysql_query("select phACode, phNum3, phNum4 from resume_dev.res_phone where phID ='".$phoneID."'");
			while($row = mysql_fetch_array($phoneSQL))
			{
				$phoneNum1 	= $row['phACode'];
				$phoneNum2 	= $row['phNum3'];
				$phoneNum3 	= $row['phNum4'];
			
				//Create Phone Number
				$phoneNumber = "(".$phoneNum1.") ".$phoneNum2."-".$phoneNum3;
				
				echo "<h1>".$userName."</h1>";
				if ($localAd != false) { echo "<h3>".$localAddress."</h3>"; }
				if ($homeAd != false) { echo "<h3>".$homeAddress."</h3>"; }
				echo "<h3>".$phoneNumber."&nbsp;&#8226;&nbsp;<a href='mailto:".$userEmail."' class='noline'>".$userEmail."</a></h3>";
			}
		}
	}
}	

function populateEducation($userID)
{
	$educationSQL	= mysql_query("select edID, edSchoolName, edSchoolCity, edSchoolState, edCollege, edStart, edEnd from resume_dev.res_education where userID='".$userID."'");
	while($row = mysql_fetch_array($educationSQL))
	{
		$edID	= $row['edID'];
		// School Name
		echo "<span class='school'>".$row['edSchoolName']."</span>";
		if ($row['edEnd'] == NULL) // Check to see if the final year of school for this edID is null.
		{ $edEnd	= "Present"; } // Says "Present" if still in school
		else { $edEnd	= $row['edEnd'];} // Last Year of school
		echo "<span class='timeframe'>".$row['edStart']." &#8211; ".$edEnd."</span>"; // First Year of school
		echo "<span class='citystate'>".$row['edSchoolCity'].", ".$row['edSchoolState']."</span><br />"; // City for edID
		echo "<span class='college'>".$row['edCollege']."</span><br />"; // Sub-school for edID [University->College]
		
		$degreeSQL	= mysql_query("select edDID, edDegree from resume_dev.res_ed_degree where userID='".$userID."' and edID='".$edID."'");
		while($line = mysql_fetch_array($degreeSQL))
		{
			$edDID	= $line['edDID']; // Get degreeID
			echo "<span class='degree'>".$line['edDegree']."</span><br />"; // List individual degrees.
		}
		$majorCountSQL = mysql_query("select count(edMajor) as edMajorC from resume_dev.res_ed_major where userID='" . $userID . "' and edID='" . $edID . "'"); // Gets the total number of Majors for one person at one edID
		$majorSQL = mysql_query("select edMajor from resume_dev.res_ed_major where userID='" . $userID . "' and edID='" . $edID . "' order by edMajor asc"); // Lists all Majors for one person at once edID
		while($mjCS = mysql_fetch_array($majorCountSQL))
		{ $majorCount = $mjCS['edMajorC']; }
		if ($majorCount == 3) // For more than one major...
		{ echo "<span class='major'>Triple Major:  "; }
		elseif ($majorCount == 2)
		{ echo "<span class='major'>Dual Major:  "; }
		else // ...we count it down.
		{ echo "<span class='major'>Major:  "; }
		
		$countUpMajor = 1;
		while($mjS = mysql_fetch_array($majorSQL))
		{
			if ($majorCount > $countUpMajor)
			{ 
				echo $mjS['edMajor'] . ", "; 
				$countUpMajor++;
			}
			else
			{ echo $mjS['edMajor'] . "</span>"; }
		}
		
	}
}

function minorStuff($userID, $edID, $edDID, $minorQuant)
{
	$mCount	= 1;
	echo "<span class='minor'>";
	
	$minorSQL	= mysql_query("select edMajor from resume_dev.res_ed_major where userID='".$userID."' and edID='".$edID."' and edDID='".$edDID."' and majorType='2'");
	while($minors = mysql_fetch_array($minorSQL))
	{
		if ($mCount != $minorQuant)
		{
			$mCount++;
			$commaz	= ", ";
		}
		else { $commaz	= " ";}
		echo $minors['edMajor'].$commaz;
	}
	
	echo "</span>";
}

function populateRC($userID)
{
	$rcSQL = mysql_query("select rcCourseName, rcCourseNum, rcCourseDesc from resume_dev.res_curriculum where userID='".$userID."'");
	while($row = mysql_fetch_array($rcSQL))
	{
		if ($row['rcCourseNum'] != NULL)
		{ echo"<li>".$row['rcCourseName']." ".$row['rcCourseNum'].":  ".$row['rcCourseDesc']."</li>"; }
		else
		{ echo"<li>".$row['rcCourseName'].":  ".$row['rcCourseDesc']."</li>"; }
	}
}

function populateExp($userID)
{
	$expSQL = mysql_query("select peID, peCompName, peCompCity, peCompState, peStart, peEnd, pePosition, pePlug from resume_dev.res_proexp where userID='".$userID."'");
	while($row = mysql_fetch_array($expSQL))
	{
		echo "<article id='".$row['pePlug']."'>
			<span class='workname'>".$row['peCompName']."</span>";
			if ($row['peEnd'] != NULL)
			{ echo "<span class='timeframe'>".$row['peStart']." &#8211; ".$row['peEnd']."</span>"; }
			else
			{ echo "<span class='timeframe'>".$row['peStart']."</span>"; }
			echo "<span class='citystate'>".$row['peCompCity'].", ".$row['peCompState']."</span>
			<br />
			<span class='position'>".$row['pePosition']."</span>
			<br />
			<ul class='duties'>";
			$expDetailsSQL = mysql_query("select peDetail from resume_dev.res_pe_details where peID='".$row['peID']."'");
			while($lines = mysql_fetch_array($expDetailsSQL))
			{
				echo "<li>".$lines['peDetail']."</li>";
			}
			echo "</ul>
		</article>";
	}
}

function populateIntAct($userID)
{
	$intactSQL = mysql_query("select iaDesc from resume_dev.res_intact where userID='".$userID."'");
	while($row = mysql_fetch_array($intactSQL))
	{ echo "<li>".$row['iaDesc']."</li>"; }
}

function populateTechExp($userID)
{
	$techexpSQL = mysql_query("select teDesc from resume_dev.res_techexp where userID='".$userID."'");
	while($row = mysql_fetch_array($techexpSQL))
	{ echo "<li>".$row['teDesc']."</li>"; }
}

function populateTechDetails($userID,$teCount)
{
	$teCount = 0;
	echo "<ul class='techDetails'><li><section class='techskills'><span class='teTitle'>Languages:\t\t</span>";
	populateTEDetails($userID,1);
	echo "</section></li><li><section class='techskills'><span class='teTitle'>Operating Systems:\t</span>";
	populateTEDetails($userID,2);
	echo "</section></li><li><section class='techskills'><span class='teTitle'>Programs:\t\t</span>";
	populateTEDetails($userID,3);
	echo "</section></li><li><section class='techskills'><span class='teTitle'>Other:\t\t</span>";
	populateTEDetails($userID,4);
	echo "</section></li></ul>";
}

function populateTEDetails($userID,$teType)
{
	$techCountUp = 1;
	$weeTECHEXPSQL = mysql_query("select count(teDesc) as anotherCounter from resume_dev.res_techexp where userID='".$userID."' and teType='".$teType."' order by teID");
	while($row = mysql_fetch_array($weeTECHEXPSQL))
	{ $techCounter = $row['anotherCounter']; }
	$BIGtechexpSQL = mysql_query("select teDesc from resume_dev.res_techexp where userID='".$userID."' and teType='".$teType."' order by teID");
	while($row = mysql_fetch_array($BIGtechexpSQL))
	{
		if ($techCounter > $techCountUp)
		{
			echo "<li class='teDesc'>" . $row['teDesc'] . ", </li>";
			$techCountUp++;
		}
		else
		{ echo "<li class='teDesc'>" . $row['teDesc'] . "</li>"; }
	}
}

function getShortName($userID)
{
	$getsn = mysql_query("select shortcode from resume_dev.res_user where userID='".$userID."'");
	while($row = mysql_fetch_array($getsn))
	{
		$shortname	= $row['shortcode']; 
		echo $shortname;
	}
}
function getPath($userID)
{
	$getsn = mysql_query("select userFName, userLName from resume_dev.res_user where userID='".$userID."'");
	while($row = mysql_fetch_array($getsn))
	{ 
		$userFName	= $row['userFName']; 
		$userLName	= $row['userLName']; 
		echo $uriName	= "./".getShortName($userID)."/".$userFName.".".$userLName.".Resume";
	}
}
?>
>>>>>>> cce638a96bbdf0cfe02d97b6685f4200ab6004d6
