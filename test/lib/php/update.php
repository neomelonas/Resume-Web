What do you want to do?
<ol>
	<li>Create a new user</li>
	<li>Add a new Education Item</li>
	<li>Add new Relevant Curriculum</li>
	<li>Add a new Professional Experience</li>
	<li>Add an Interest/Activity</li>
	<li>Add Technology Experience</li>
</ol>


<? 
	function createUser($middleyn, $firstname, $middlename, $lastname)
	{
		mysql_query("insert into resume.res_user (userFName, userLName, userEmail) values ('".$firstname."','".$lastname."','".$emailad."')");
		$sql = mysql_query("select userID from resume.res_user where userFName='".$firstname."' and userLName='".$lastname."'");
		while($row = mysql_fetch_array($sql))
		{
			$userID		= $row['userID'];
			if ($middleyn != 0)
			{
				mysql_query("update resume.res_user where userID='".$userID."' set userMName='".$middlename."'");
				if ($midnick !=0)
				{
					mysql_query("insert into resume.res_user_pref (userID, middleISnick) values ('".$userID."','1')");
				} else
				{	
					mysql_query("insert into resume.res_user_pref (userID, middleISnick) values ('".$userID."','0')");
				}
			}
			mysql_query("insert into resume.res_phone (phACode, phNum3, phNum4, phType) values ('".$areacode."','".$first3."','".$next4."','".$phonetype."')");
			$phSQL = mysql_query("select phID from resume.res_phone where phNum3='".$first3."' and phNum4='".$next4."'");
			while($row = mysql_fetch_array($phSQL))
			{
				$thisphone	= $row['phID'];
				if ($prefPhone != 0)
				{
					mysql_query("update resume.res_user_pref where userID='".$userID."' set preferredPH='".$thisphone."'");
				}
			}
		}
	}

	function newEducation($uemail, $seconddeg)
	{
		$sql = mysql_query("select userID from resume.res_user where userEmail='".$uemail."'");
		while($row = mysql_fetch_array($sql))
		{
			$userID		= $row['userID'];
			if ($secondDeg != 0)
			{
				mysql_query("insert into resume.res_education (edSchoolName, edSchoolCity, edSchoolState, edSchoolCollege, edDegree, edMajor, edMajor2, edStart, edEnd, userID)
				values ('".$schname."','".$schcity."','".$schstate."','".$schcollege."','".$schdegree."','".$schmajor."','".$schmajor2."','".$schstart."','".$schend."','".$userID."')");
			}
		}
	}

	function addCurriculum($uemail)
	{
		$sql = mysql_query("select userID from resume.res_user where userEmail='".$uemail."'");
		while($row = mysql_fetch_array($sql))
		{
			$userID		= $row['userID'];
			mysql_query("insert into resume.res_curriculum (rcCourseName, rcCourseNumber, rcCourseDesc, userID)
			values ('".$coursename."', '".$coursenum."', '".$courseDesc."')");
		}
	}

	function addIntAct($uemail)
	{
		$sql = mysql_query("select userID from resume.res_user where userEmail='".$uemail."'");
		while($row = mysql_fetch_array($sql))
		{
			$userID		= $row['userID'];
			mysql_query("insert into resume.res_intact (iaDesc, userID) values ('".$intactd."', '".$userID."')");
		}

	}
	
	function addTechExp($uemail)
	{
		$sql = mysql_query("select userID from resume.res_user where userEmail='".$uemail."'");
		while($row = mysql_fetch_array($sql))
		{
			$userID		= $row['userID'];
			mysql_query("insert into resume.res_techexp (teDesc, userID) values ('".$techexpd."', '".$userID."')");
		}

	}
	
	
?>