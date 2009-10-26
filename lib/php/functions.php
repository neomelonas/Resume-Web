<?php 

$con = mysql_connect($host,$name,$pwd);

$localAd	= false;
$homeAd		= false;

function populateName($con, $userID)
{
	if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
	else
	{
		mysql_select_db($db, $con);
		
		$nameSQL = mysql_query("select userFName, userMName, userLName from resume.res_user where userID='".$userID."'");
		while($row = mysql_fetch_array($nameSQL))
		{
			$userFName	= $row['userFName'];
			$userMName	= $row['userMName'];
			$userLName	= $row['userLName'];
			
			$prefSQL = mysql_query("select middleISnick from resume.res_user_pref where userID='".$userID."'");
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
}

function populateHeader($userID)
{
	$sql1 = mysql_query("select userFName, userMName, userLName, userEmail, locLID, locHID from resume.res_user where userID='".$userID."'");

	while($row = mysql_fetch_array($sql1))
	{
		$userFName	= $row['userFName'];
		$userMName	= $row['userMName'];
		$userLName	= $row['userLName'];
		$userEmail	= $row['userEmail'];
		$localID 	= $row['locLID'];
		$homeID		= $row['locHID'];
		
		$prefSQL = mysql_query("select middleISnick, preferredPH from resume.res_user_pref where userID='".$userID."'");
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
				$localSQL = mysql_query("select locStreet1, locStreet2, locCity, locState, locZIP from resume.res_loc where locID = '".$localID."'");
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
				$homeSQL = mysql_query("select locStreet1, locStreet2, locCity, locState, locZIP from resume.res_loc where locID = '".$homeID."'");
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
			

			
			
			$phoneSQL = mysql_query("select phACode, phNum3, phNum4 from resume.res_phone where phID ='".$phoneID."'");
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
	$educationSQL = mysql_query("select edID, edSchoolName, edSchoolCity, edSchoolState, edSchoolCollege, edStart, edEnd from resume.res_education where userID='".$userID."'");
	while($row = mysql_fetch_array($educationSQL))
	{
		echo "<span class='school'>".$row['edSchoolName']."</span>";
		echo "<span class='timeframe'>".$row['edStart']." &#8211; ".$row['edEnd']."</span>";
		echo "<span class='citystate'>".$row['edSchoolCity'].", ".$row['edSchoolState']."</span><br />";
		echo "<span class='college'>".$row['edSchoolCollege']."</span><br />";
		
		$edDegSQL = mysql_query("select edDegree from resume.res_ed_degree where userID'".$userID."' and edID='".$row['edID']."'");
		while($linez = mysql_fetch_array($edDegSQL))
			{ echo "<span class='degree'>".$linez['edDegree']."</span>"; }
		
		$edMajorCountSQL = mysql_query("select edType, count(edType) as edCount from resume.res_ed_major where userID='".$userID."' and edID='".$row['edID']."' group by edType");
		while($majorCount = mysql_fetch_array($edMajorCountSQL))
		{
			$count = $majorCount['edCount'];
			$type = $majorCount['edType'];
			if ($type == 1)
			{
				if ($count == 3)
				{
					echo "<br />Triple Major:  ";
				}
				else if ($count == 2)
				{
					echo "<br />Dual Major:  ";
				}
				else { echo "<br />Major:  "; }
			}
			if ($type == 2)
			{
				if ($count > 1)
				{
					echo "<br />Minors:  ";
				}
				else { echo "<br />Minor:  "; }
			}
			
		}
		
		$edMajorzSQL = mysql_query("select edMajor, edType from resume.res_ed_major where userID='".$userID."' and edID='".$row['edID']."' order by edType asc");
		while($majorRow = mysql_fetch_array($edMajorzSQL))
		{
			if ($majorRow['edType'] == 1)
			{
				echo "<span class='major'>".$majorRow['edMajor']."</span>";
			}
			elseif ($majorRow['edType'] == 2)
			{
				echo "<span class='major'>".$majorRow['edMajor']."</span>";
			}
		}
		echo "<br />"
		
	}
}

function populateRC($userID)
{
	$rcSQL = mysql_query("select rcCourseName, rcCourseNumber, rcCourseDesc from resume.res_curriculum where userID='".$userID."'");
	while($row = mysql_fetch_array($rcSQL))
	{
		if ($row[''] != NULL)
		{ echo"<li>".$row['rcCourseName']." ".$row['rcCourseNumber'].":  ".$row['rcCourseDesc']."</li>"; }
		else
		{ echo"<li>".$row['rcCourseName'].":  ".$row['rcCourseDesc']."</li>"; }
	}
}

function populateExp($userID)
{
	$expSQL = mysql_query("select peID, peCompName, peCompCity, peCompState, peStart, peEnd, pePosition, pePlug from resume.res_proexp where userID='".$userID."'");
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
			$expDetailsSQL = mysql_query("select peDetail from resume.res_pe_details where peID='".$row['peID']."'");
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
	$intactSQL = mysql_query("select iaDesc from resume.res_intact where userID='".$userID."'");
	while($row = mysql_fetch_array($intactSQL))
	{ echo "<li>".$row['iaDesc']."</li>"; }
}

function populateTechExp($userID)
{
	$techexpSQL = mysql_query("select teDesc from resume.res_techexp where userID='".$userID."'");
	while($row = mysql_fetch_array($techexpSQL))
	{ echo "<li>".$row['teDesc']."</li>"; }
}

function getShortName($userID)
{
	$getsn = mysql_query("select userFName, userLName, shortname from resume.res_user where userID='".$userID."'");
	while($row = mysql_fetch_array($getsn))
	{ 
		$userFName	= $row['userFName']; 
		$userLName	= $row['userLName']; 
		$shortname	= $row['shortname']; 
		
		echo $uriName	= "./".$shortname."/".$userFName.".".$userLName.".Resume";
	}
}

?>