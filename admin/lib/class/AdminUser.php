<?php
/**
 * @package resume-web
 * @subpackage admin
 */
/**
 * Description of AdminUser
 * @package resume-web
 * @subpackage admin
 * @author Neo
 * @version 3.0.9
 * @since 3.0.9
 * @copyright 2010 Neo Melonas
 */
class AdminUser {
    public $dbcon;
    public $arr;
    public $types;
    public $numLanguage;
    public $numOS;
    public $numProgram;
    public $numOther;

    function __contruct($dbcon){
	$this->dbcon = $dbcon;
	$this->types = array('language'=>new ArrayObject(),'OS' => new ArrayObject(),'program' => new ArrayObject(),'other' => new ArrayObject());
    }
    public function getUserName($dbcon){
	$sql = $dbcon->query("
	    SELECT `userID`, `userFName`, `middleASnick`, `userMName`
	    FROM `res_user`
	    WHERE `username` LIKE \"%" . $_SESSION['unm'] . "%\"
	");
	while($row = $sql->fetch_object()){
	    $_SESSION['uid'] = $row->userID;
	    if ($row->middleASnick){
		$name = $row->userMName;
	    }
	    else{
		$name = $row->userFName;
	    }
	}
	return $name;
    }

    public function editSection($section, $dbcon){
	echo "<input type=\"hidden\" name=\"type\" value=\"". $section ."\"/>";
	switch ($section){
	    case "user":
		$userSQL = $dbcon->query("
		    SELECT `userFName`,`userMName`,`userLName`,`middleASnick`,`userEmail`,`phonenum`
		    FROM res_user
		    WHERE userID='" . $_SESSION['uid'] . "'
		");
		while($row = $userSQL->fetch_object()){
		    $fn = $row->userFName;
		    $mn = $row->userMName;
		    $ln = $row->userLName;
		    $mAn = $row->middleASnick;
		    $email = $row->userEmail;
		    $phn = $row->phonenum;
		}
		?>
		<fieldset><legend>Name</legend>
		    <p><label for="fn">First Name: </label><input type="text" name="fn" value="<?php echo $fn; ?>"/></p>
		    <p><label for="mn">Middle Name: </label><input type="text" name="mn" value="<?php echo $mn; ?>"/></p>
		    <p><label for="ln">Last Name: </label><input type="text" name="ln" value="<?php echo $ln; ?>"/></p>
		<?php
		if ($mAn){
		    $mAnBox = "<input type=\"checkbox\" name=\"mAn\" checked=\"checked\"/>";
		}
		else{
		    $mAnBox = "<input type=\"checkbox\" name=\"mAn\" />";
		}
		?>
		<p>Is your middle name a <label for="mAn">nickname</label>?<?php echo $mAnBox; ?>
		</fieldset>
		<fieldset>
		    <legend>Phone Number</legend>
		    <p>Format like: xxx-xxx-xxxx</p>
		    <input type="text" name="phn" maxlength="10" value="<?php echo $phn; ?>"/>
		</fieldset>
		<?php
		$loccounter = 1;
		$locSQL = $dbcon->query("
		    SELECT `locStreet`,`locStreet2`,`locCity`,`locState`,`locZIP`,ul.homeLoc
		    FROM res_user_loc ul
		    INNER JOIN res_location l ON ul.locID=l.locID
		    WHERE ul.userID='". $_SESSION['uid'] ."'
		");
		while($row = $locSQL->fetch_object()){
		    $hLoc = $row->homeloc;
		    ?>
		    <fieldset class="location">
			<legend>Location #<?php echo $loccounter; ?></legend>
			<p><label>Street 1: </label><input type="text" name="street1" value="<?php echo $row->locStreet; ?>" /></p>
			<p><label>Street 2: </label><input type="text" name="street2" value="<?php echo $row->locStreet2; ?>" /></p>
			<p>
			    <label for="city">City: </label><input type="text" name="city" value="<?php echo $row->locCity; ?>" />
			    <label for="state">State: </label><input type="text" name="state" maxlength="2" size="2" value="<?php echo $row->locState; ?>" />
			    <label for="zip">Zip Code: </label><input type="text" name="zip" maxlength="5" size="5" value="<?php echo $row->locZIP; ?>"/>
			</p>
			<p><label for="homeLoc">Is this a "home" location?</label>
			    <?php
			    if ($hLoc){
				echo "<input type=\"checkbox\" name=\"homeLoc\" checked=\"checked\"/>";
			    }
			    else{
				echo "<input name=\"homeLoc\" type=\"checkbox\"/>";
			    }
			    ?>
			</p>
		    </fieldset>
		    <?php
		    $loccounter++;
		}
		break;
	    case "education":
		break;
	    case "courses":
		break;
	    case "exp":
		break;
	    case "intact":
		break;
	    case "tech":
		break;
	    case "other":
		break;
	}
    }

    public function makeUpdates($dbcon,$section){
	switch ($section){
	    case "user":
		$this->updateUser($dbcon);
		break;
	}
    }

    public function addNewUser
    (
	$dbcon, $fname, $mname, $lname, $email, $mAn, $phone,$uname, $theme, $statement, $objective
    )
    {
	$uID = 0;
	$email = $dbcon->real_escape_string($email);
	$pass = sha1($uname);
	$query = "CALL procInsertNewUser ('".$fname."','".$mname."','".$lname.
	"','".$email."','".$mAn."','".$phone."','".$uname."','".$pass."','".
	$theme."','".$statement."','".$objective."',@uID); SELECT @uID;";
	$dbcon->multi_query($query);
	do {
	    if ($result = $dbcon->use_result){
		while ($row = $result->fetch_row()){
		    $uID = $row[0];
		    echo $uID;
		}
		$result->close();
	    }
	    if ($dbcon->more_results()){
	    }
	} while($dbcon->next_result());
	if ($dbcon->errno){
	    echo "CRAP! " . $dbcon->error;
	}
    }
    private function updateUser($dbcon){
	$sql = $dbcon->query("
	    UPDATE res_user
	    SET userFName='". $_POST['fn'] ."'
	    , userMName='". $_POST['mn'] ."'
	    , userLName='". $_POST['ln'] ."'
	    , userEmail='". $_POST['email'] ."'
	    , phonenum='". $_POST['phn'] ."'
	    WHERE userID='".$_SESSION['uid']."'
		    ");
	$sql2 = $dbcon->query("
	");
	$sql->execute;
    }
    public function getTechItems($dbcon){
	$this->types = array('language'=>new ArrayObject(),'OS' => new ArrayObject(),'program' => new ArrayObject(),'other' => new ArrayObject());
	$this->arr = new ArrayObject($this->types);
	foreach ($this->types as $type=>$x){
	    $counter = 0;
	    $query = "SELECT teID, teDesc, teType FROM res_techexp WHERE teType='".$type."'";
	    $sql = $dbcon->query($query);
	    switch ($type){
		case 'language':
		    $this->numLanguage = $sql->num_rows;
		break;
		case 'OS':
		    $this->numOS = $sql->num_rows;
		break;
		case 'program':
		    $this->numProgram = $sql->num_rows;
		break;
		case 'other':
		    $this->numOther = $sql->num_rows;
		break;
	    }
	    while($row = $sql->fetch_object()){
		$thing = '<input type="checkbox" id="'.$type.$row->teID.'" value="'.$row->teID.'" name="'.$row->teID.'"><label for="'.$type.$row->teID.'">'.$row->teDesc.'</label></input>';
		$this->arr->offsetGet($type)->offsetSet($counter, $thing);
		$counter++;
	    }
	}
    }
    public function showTechItems($dbcon){
	$this->getTechItems($dbcon);
	$iter = $this->arr->getIterator();
	while($iter->valid()){
	    $iter2 = $this->arr->offsetGet($iter->key())->getIterator();
	    echo "<fieldset id=\"". $iter->key() ."\"><legend>".strtoupper($iter->key())."</legend>";
	    while($iter2->valid()){
		echo $iter2->current()."<br/>";
		$iter2->next();
	    }
	    echo "</fieldset>";
	    $iter->next();
	}
    }
    public function displayTechForm($dbcon, $action = null){
	echo '<form action="'.$action.'" method="POST">
	<input type="submit" class="bigbutton" value="Add to Resume" name="add" />
	<input type="reset" class="bigbutton" value="OOPS! Try again." name="reset" />';
	$this->showTechItems($dbcon);
	    echo '<fieldset id="alternate">
		<legend>Or, add your own!</legend>
		<label for="teDesc">New Professional Skill</label><br/>
		<input type="text" value="" id="teDesc" size="100" maxlength="200" name="teDesc"/><br/>
		<input type="radio" value="language" name="type" id="ttLa" /><label for="ttLa">Language</label>
		<input type="radio" value="OS" name="type" id="ttOS" /><label for="ttOS">Operating System</label>
		<input type="radio" value="program" name="type" id="ttPr" /><label for="ttPr">Program</label>
		<input type="radio" value="other" name="type" id="ttOt" /><label for="ttOt">Other</label>
	    </fieldset></form>';
    }
    public function insertFromTechForm(){
	if (isset($_POST['add']) && $_POST['add'] == "Add to Resume"){
	    $teDesc = $_POST['teDesc'];
	    $teType = $_POST['type'];

	}
    }
}
?>
