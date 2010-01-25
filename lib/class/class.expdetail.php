<?php
/**
 * @package multiuser-resume
 */

/**
 * ExpDetail extends Experience
 * It allows users to list different attributes of their
 * professional experience.
 *
 * @author neomelonas
 * @version v3.0.3
 * @since v3.0.3
 */
class ExpDetail extends Experience {

    function __construct($dbcon,$userID) { $this->fillProExp($dbcon,$userID);$this->fillExpDetail($dbcon,$userID); }

    // Gets
    //public function getExpDetail() { return $this->detail; }

    // Sets
    //private function setExpDetail($EXTdetail) { $this->detail = $EXTdetail; }

    protected function fillExpDetail($dbcon,$userID){
	$sql = $dbcon->query("SELECT `expPosID`,`detailID`, `detailDesc` FROM res_exp_detail D INNER JOIN res_user_exp UE on D.posID=UE.expPosID WHERE userID='" . $userID . "'");
	while($row = $sql->fetch_object()){
	    $this->exp->offsetGet($row->expPosID)->offsetGet('details')->append($row->detailDesc);
	}
//	print_r($this->exp);
    }
    public function showExperience(){
        
    }

}
?>
