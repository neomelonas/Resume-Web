<?php
/**
 * @package multiuser-resume
 */
/**
 * The Focus class extends the Education class, and enables the
 * user to have majors and minors.  Eventually.
 *
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.3
 * @since v3.0.3
 * @@copyright 2009-2010 Neo Melonas
 *
 * @todo MAKE THINGS WORK x_x
 */
class  Focus extends Education {

    function __construct($dbcon,$userID) {$this->fillMajors($dbcon, $userID);}

    private function fillMajors($dbcon,$userID){
	$sql = $dbcon->query("SELECT `ucID`, `majorName`, `gpa` FROM res_ed_major M INNER JOIN res_user_major UM on M.majorID=UM.majorID INNER JOIN res_user_ed UE on UM.ecdID=UE.ucID WHERE UE.userID='". $userID ."'");
	while($row = $sql->fetch_object()){
	
	}
	print_r($this->ed);
    }
}
?>