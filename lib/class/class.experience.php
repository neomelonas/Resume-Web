<?php
/**
 * @package multiuser-resume
 */

/**
 * The Experience class logics out the info for
 * Professional Experience
 *
 * @author neomelonas
 * @version v3.0.3
 * @since v3.0.3
 */
class Experience {
    protected $exp;
    protected $expID;
    protected $expName;
    protected $expCity;
    protected $expState;
    protected $expPosition;
    protected $expStartMonth;
    protected $expStartYear;
    protected $expEndMonth;
    protected $expEndYear;

    function __construct($dbcon,$userID) { $this->fillProExp($dbcon,$userID); }

    // Gets
    public function getExpID() { return $this->expID; }
    public function getExpName() { return $this->expName; }
    public function getExpCity() { return $this->expCity; }
    public function getExpState() { return $this->expState; }
    public function getExpPosition() { return $this->expPosition; }
    public function getExpStartMonth() { return $this->expStartMonth; }
    public function getExpStartYear() { return $this->expStartYear; }
    public function getExpEndMonth() { return $this->expEndMonth; }
    public function getExpEndYear() { return $this->expEndYear; }

    // Sets
    protected function setExpID ($EXTexpID) { $this->expID = $EXTexpID; }
    //protected function setExpName ($offset,$EXTexpName) { $this->exp->offsetGet($offset)->offsetSet('name',$EXTexpName); }
    protected function setExpCity ($EXTexpCity) { $this->expCity = $EXTexpCity; }
    protected function setExpState ($EXTexpState) { $this->expState = $EXTexpState; }
    protected function setExpPostion ($EXTexpPosition) { $this->expPosition = $EXTexpPostion; }
    protected function setExpStartMonth ($EXTexpStartMonth) { $this->expStart = $EXTexpStartMonth; }
    protected function setExpStartYear ($EXTexpStartYear) { $this->expStartYear = $EXTexpStartYear; }
    protected function setExpEndMonth ($EXTexpEndMonth) { $this->expEndMonth = $EXTexpEndMonth; }
    protected function setExpEndYear ($EXTexpEndYear) { $this->expEndYear = $EXTexpEndYear; }

    protected function fillProExp($dbcon, $userID){
	$this->exp = new ArrayObject();
	$sql = $dbcon->query("SELECT PE.expID, `expName`,`expCity`,`expState`,`expPosition`,`expStartMonth`,`expStartYear`,`expEndMonth`,`expEndYear` FROM res_proexp PE INNER JOIN res_user_exp UE on PE.expID=UE.expID WHERE userID='" . $userID . "' ORDER BY expStartYear DESC");
	while($row = $sql->fetch_object()){
	    $this->setExpID($row->expID);
//	    $this->setExpName($row->expID,$row->expName);
//	    $this->setExpCity($row->expCity);
//	    $this->setExpState($row->expState);
//	    $this->setExpPostion($row->expPosition);
//	    $this->setExpStartMonth($row->expStartMonth);
//	    $this->setExpStartYear($row->expStartYear);
//	    $this->setExpEndMonth($row->expEndMonth);
//	    $this->setExpEndYear($row->expEndYear);

	    $this->exp->offsetSet($row->expID,new ArrayObject());
	    $this->exp->offsetGet($row->expID)->offsetSet('name',$row->expName);
	    $this->exp->offsetGet($row->expID)->offsetSet('city',$row->expCity);
	    $this->exp->offsetGet($row->expID)->offsetSet('state',$row->expState);
	    $this->exp->offsetGet($row->expID)->offsetSet('position',$row->expPosition);
	    $this->exp->offsetGet($row->expID)->offsetSet('startMonth',$row->expStartMonth);
	    $this->exp->offsetGet($row->expID)->offsetSet('startYear',$row->expStartYear);
	    $this->exp->offsetGet($row->expID)->offsetSet('endMonth',$row->expEndMonth);
	    $this->exp->offsetGet($row->expID)->offsetSet('endYear',$row->expEndYear);
	    $this->exp->offsetGet($row->expID)->offsetSet('details',new ArrayObject());


	}
    }

    protected function showExpDate(){
	$dateRange = null;
	echo "<span class=\"timeframe\">";
	$dateRange = $this->getExpStartMonth(). " " . $this->getExpStartYear();
	if ((($this->getExpEndMonth()) == $this->getExpStartMonth()) && (($this->getExpEndYear()) == $this->getExpStartYear())){
	    echo "<span>";
	}
	else{
	    if ((!is_null($this->getExpEndMonth())) && (!is_null($this->getExpEndYear()))) {
		$dateRange +=  " &ndash; " . $this->getExpEndMonth() . " " . $this->expEndYear();
		echo "<span>";
	    }
	    else {
		$dateRange +=  " &ndash; Present";
		echo "<span>";
	    }
	}
    }
}
?>
