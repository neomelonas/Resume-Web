<?php
/**
 * @package multiuser-resume
 */
/**
 * The Experience class logics out the info for
 * Professional Experience
 *
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.3
 * @copyright 2009-2010 Neo Melonas
 */
class Experience {
    
    /**
     * The exp object
     * 
     * This is really the only thing that needs to hang around.
     * 
     * @var object This sucker is the main object of Experience, containing all of the stuff.
     * @since v3.0.2
     */
    protected $exp;
    
    /**
     * Class constructor
     *
     * Constructs the class.
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    function __construct($dbcon,$userID) { $this->fillProExp($dbcon,$userID); }

    /**
     * getExpID
     *
     * Gets the expID for the instance of the class Experience.
     *
     * @return int Returns the instance's expID
     */
    public function getExpID() { 
	return $this->expID;
    }

    /**
     * getExpName
     * 
     * Gets the expName for the instance of the class Experience.
     * 
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expName
     */
    public function getExpName($offset) { 
	return $this->exp->offsetGet($offset)->offsetGet('expName');
    }

    /**
     * getExpCity
     *
     * Gets the expCity for the instance of the class Experience.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expCity.
     */
    public function getExpCity($offset) { 
	return $this->exp->offsetGet($offset)->offsetGet('expCity');
    }

    /**
     * getExpState
     *
     * Gets the expState for the instance of the class Experience.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expState.
     */
    public function getExpState($offset) { 
	return $this->exp->offsetGet($offset)->offsetGet('expState');
    }

    /**
     * getExpPosition
     *
     * Gets the expPosition for the instance of the class Experience.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expPosition.
     */
    public function getExpPosition($offset) { 
	return $this->exp->offsetGet($offset)->offsetGet('expPosition');
    }

    /**
     * getExpStartMonth
     *
     * Gets the expStartMonth for the instance of the class Experience.
     *
     * It shows what month the users started his or her Professional Experience.
     * When combined with getExpStartYear, creates the start date for the
     * aforementioned ProExp.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expStartMonth.
     */
    public function getExpStartMonth($offset) {
	return $this->exp->offsetGet($offset)->offsetGet('expStartMonth');
    }

    /**
     * getExpStartYear
     *
     * Gets the expStartYear for the instance of the class Experience.
     *
     * It shows what year the users started his or her Professional Experience.
     * When combined with getExpStartMonth, creates the start date for the
     * aforementioned ProExp.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return int Returns the instance's expStartYear
     */
    public function getExpStartYear($offset) { 
	return $this->exp->offsetGet($offset)->offsetGet('expStartYear');
    }

    /**
     * getExpEndMonth
     *
     * Gets the expEndMonth for the instance of the class Experience.
     *
     * If an endMonth exisits, it shows when the ProExp from the specified
     * offset ends.  It works much better with getExpEndYear than alone.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expEndMonth.
     */
    public function getExpEndMonth($offset) { return $this->exp->offsetGet($offset)->offsetGet('expEndMonth'); }

    /**
     * getExpEndYear
     * 
     * Gets the expEndYear for the instance of the class Experience.
     * 
     * If an endYear exisits, it shows when the ProExp from the specified 
     * offset ends.  It works much better with getExpEndMonth than alone.
     * 
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the instance's expEndYear.
     */
    public function getExpEndYear($offset) {
	return $this->exp->offsetGet($offset)->offsetGet('expEndYear');
    }

    /**
     * setExpID
     *
     * Method to set the expID.
     *
     * @param int $EXTexpID The input Experience ID.
     */
    protected function setExpID ($EXTexpID) { 
	$this->expID = $EXTexpID;
    }

    /**
     * setExpName
     *
     * Method to set expName.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpName The input expName string.
     */
    protected function setExpName ($offset,$EXTexpName) { 
	$this->exp->offsetGet($offset)->offsetSet('name',$EXTexpName);
    }

    /**
     * setExpCity
     *
     * Method to set expCity.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpCity The input to set expCity.
     */
    protected function setExpCity ($offset,$EXTexpCity) {
	$this->exp->offsetGet($offset)->offsetSet('city',$EXTexpCity);
    }

    /**
     * setExpState
     * 
     * Method to set expState.
     * 
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpState The input to set expState.
     */
    protected function setExpState ($offset,$EXTexpState) {
	$this->exp->offsetGet($offset)->offsetSet('state',$EXTexpState);
    }

    /**
     * setExpPosition
     *
     * Method to set expPosition.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpPosition The input to set expPosition.
     */
    protected function setExpPosition ($offset,$EXTexpPosition) {
	$this->exp->offsetGet($offset)->offsetSet('position',$EXTexpPostion);
    }

    /**
     * setExpStartMonth
     *
     * Method to set expStartMonth.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpStartMonth The input to set expStartMonth.
     */
    protected function setExpStartMonth ($offset,$EXTexpStartMonth) {
	$this->exp->offsetGet($offset)->offsetSet('startMonth',$EXTexpStartMonth);
    }

    /**
     * setExpStartYear
     *
     * Method to set expStartYear.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpStartYear The input to set expStartYear
     */
    protected function setExpStartYear ($offset,$EXTexpStartYear) {
	$this->exp->offsetGet($offset)->offsetSet('stateYear',$EXTexpStartYear);
    }

    /**
     * setExpEndMonth
     *
     * Method to set expEndMonth.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpEndMonth The input to set expEndMonth.
     */
    protected function setExpEndMonth ($offset,$EXTexpEndMonth) {
	$this->exp->offsetGet($offset)->offsetSet('endMonth',$EXTexpEndMonth);
    }

    /**
     * setExpEndYear
     *
     * Method to set expEndYear.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @param string $EXTexpEndYear The input to set expEndYear
     */
    protected function setExpEndYear ($offset,$EXTexpEndYear) {
	$this->exp->offsetGet($offset)->offsetSet('endYear',$EXTexpEndYear);
    }

    /**
     * fillProExp
     *
     * This method fills the Experience class with juicy data.
     *
     * It takes 2 parameters.
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    protected function fillProExp($dbcon, $userID){
	$this->exp = new ArrayObject();
	$sql = $dbcon->query("SELECT PE.expID, `expName`,`expCity`,`expState`,`expPosition`,`expStartMonth`,`expStartYear`,`expEndMonth`,`expEndYear` FROM res_proexp PE INNER JOIN res_user_exp UE on PE.expID=UE.expID WHERE userID='" . $userID . "' ORDER BY expStartYear DESC");
	while($row = $sql->fetch_object()){
	    $this->setExpID($row->expID);
	    $this->exp->offsetSet($row->expID,new ArrayObject());
	    $this->setExpName($row->expID,$row->expName);
	    $this->setExpCity($row->expID,$row->expCity);
	    $this->setExpState($row->expID,$row->expState);
	    $this->setExpPosition($row->expID,$row->expPosition);
	    $this->setExpStartMonth($row->expID,$row->expStartMonth);
	    $this->setExpStartYear($row->expID,$row->expStartYear);
	    $this->setExpEndMonth($row->expID,$row->expEndMonth);
	    $this->setExpEndYear($row->expID,$row->expEndYear);
	    $this->exp->offsetGet($row->expID)->offsetSet('details',new ArrayObject());
	}
    }

    /**
     * This method shows off what the time frame of employment is.
     *
     * It takes no parameters.
     */
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
