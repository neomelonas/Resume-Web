<?php
/**
 * @package multiuser-resume
 */

/**
 * ExpDetail extends Experience
 * It allows users to list different attributes of their
 * professional experience.
 *
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.3
 * @copyright 2009-2010 Neo Melonas
 */
class ExpDetail extends Experience {

    /**
     * This is the Class Constructor.
     *
     * It constructs the class.
     *
     * Hurf Durf.
     * 
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    function __construct($dbcon,$userID) { $this->fillProExp($dbcon,$userID);$this->fillExpDetail($dbcon,$userID); }

    // Gets
    //public function getExpDetail() { return $this->detail; }

    // Sets
    //private function setExpDetail($EXTdetail) { $this->detail = $EXTdetail; }

    /**
     * This method fills the Detail subclass with tasty data.
     *
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
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
