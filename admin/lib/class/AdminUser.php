<?php
/**
 * @package resume-web
 * @subpackage admin
 */
/**
 * Description of AdminUser
 *
 * @author Neo
 * @version 3.0.9
 * @since 3.0.9
 * @copyright 2010 Neo Melonas
 */
class AdminUser {
    public $dbcon;
    function __contruct($dbcon){
	$this->dbcon = $dbcon;
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

}
?>
