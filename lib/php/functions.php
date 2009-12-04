<?php

$con = mysql_connect($host,$name,$pwd);

$localAd	= false;
$homeAd		= false;

function getUserTag($userID)
{
	if (!$con)
		{
			die('Could not connect: ' . mysql_error());
		}
	else
	{
		mysql_select_db($db, $con);
		$userTagSQL = mysql_query('select userID from resume_dev.res_user where userTag="' . $userTag . '"');
		echo mysql_fetch_object($userTagSQL);
	}
}


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
		
		echo "<span class='school'>".$row['edSchoolName']."</span>";
		if ($row['edEnd'] == NULL)
		{ $edEnd	= "Present"; }
		else { $edEnd	= $row['edEnd'];}
		echo "<span class='timeframe'>".$row['edStart']." &#8211; ".$edEnd."</span>";
		echo "<span class='citystate'>".$row['edSchoolCity'].", ".$row['edSchoolState']."</span><br />";
		echo "<span class='college'>".$row['edCollege']."</span><br />";
		
		$degreeSQL	= mysql_query("select edDID, edDegree from resume_dev.res_ed_degree where userID='".$userID."' and edID='".$edID."'");
		while($line = mysql_fetch_array($degreeSQL))
		{
			$edDID	= $line['edDID'];
			echo "<span class='degree'>".$line['edDegree']."</span><br />";
			
			$majorCount	= mysql_query("select count(edMID) as majorCount from resume_dev.res_ed_major where userID='".$userID."' and edID='".$edID."' and edDID='".$edDID."' and majorType='1' group by edDID");
			while($majors = mysql_fetch_array($majorCount))
			{ $majorQuant	= $majors['majorCount']; }
			
			if ($majorQuant == 3)
			{
				echo "<span class='edTitle'>Triple Major:  </span>";
				majorStuff($userID, $edID, $edDID, $majorQuant);
			}
			else if ($majorQuant == 2)
			{
				echo "<span class='edTitle'>Double Major:  </span>";
				majorStuff($userID, $edID, $edDID, $majorQuant);
			}
			else 
			{ 
				echo "<span class='edTitle'>Major:  </span>";
				majorStuff($userID, $edID, $edDID, $majorQuant);
			}
			
			$minorCount	= mysql_query("select count(edMID) as minorCount from resume_dev.res_ed_major where userID='".$userID."' and edID='".$edID."' and edDID='".$edDID."' and majorType='2' group by edDID");
			while($minors = mysql_fetch_array($minorCount))
			{ $minorQuant	= $minors['minorCount']; }
			if ($minorQuant > 1)
			{
				echo "<span class='edTitle'>Minors:  </span>";
				minorStuff($userID, $edID, $edDID, $minorQuant);
			}
			else if ($minorQuant == 1)
			{
				echo "<span class='edTitle'>Minor:  </span>";
				minorStuff($userID, $edID, $edDID, $minorQuant); 
			}
			
		}
	}
}

function majorStuff($userID, $edID, $edDID, $majorQuant)
{
	$mCount	= 1;
	echo "<span class='major'>";
	
	$majorSQL	= mysql_query("select edMajor from resume_dev.res_ed_major where userID='".$userID."' and edID='".$edID."' and edDID='".$edDID."' and majorType='1'");
	while($majors = mysql_fetch_array($majorSQL))
	{
		if ($mCount != $majorQuant)
		{
			$mCount++;
			$commaz	= ", ";
		}
		else { $commaz	= " ";}
		echo $majors['edMajor'].$commaz;
	}
	
	echo "</span>";
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
		if ($row[''] != NULL)
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
	echo "<ul class='techDetails'>";
	echo "<li><section class='techskills'><span class='teTitle'>Languages:\t\t</span>";populateTEDetails($userID,1);echo "</section></li>";
	echo "<li><section class='techskills'><span class='teTitle'>Operating Systems:\t</span>";populateTEDetails($userID,2);echo "</section></li>";
	echo "<li><section class='techskills'><span class='teTitle'>Programs:\t\t</span>";populateTEDetails($userID,3);echo "</section></li>";
	echo "<li><section class='techskills'><span class='teTitle'>Other:\t\t</span>";populateTEDetails($userID,4);echo "</section></li>";
	echo "</ul>";
}

function populateTEDetails($userID,$teType)
{
	
	
	$BIGtechexpSQL = mysql_query("select teDesc from resume_dev.res_techexp where userID='".$userID."' and teType='".$teType."' order by teID");
	while($row = mysql_fetch_array($BIGtechexpSQL))
	{
		echo "<li>" . $row['teDesc'] . "</li>";
	}
}

function getShortName($userID)
{
	$getsn = mysql_query("select shortname from resume_dev.res_user where userID='".$userID."'");
	while($row = mysql_fetch_array($getsn))
	{
		$shortname	= $row['shortname']; 
		echo $shortname;
	}
}
function getPath($userID)
{
	$getsn = mysql_query("select userFName, userLName from resume_dev.res_user where userID='".$userID."'");
	while($row = mysql_fetch_array($getsn))
	{ 
		$userFName	= $row['userFName']; 

		echo $uriName	= "./".getShortName($userID)."/".$userFName.".".$userLName.".Resume";
	}
}
?>