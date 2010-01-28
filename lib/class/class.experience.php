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
     * The expID
     * 
     * @var int Placeholder for the ID of the instance. 
     */
    protected $expID;

    /**
     * A count of howManyRows there are.
     *
     * @var int How many Experiences there are.
     */
    protected $howManyRows;

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
     * getExpInfo
     *
     * getExpInfo gets any and all of the information relating to an instance of Experience,
     * except for the details, which are done in the expdetail class.
     *
     * @since v3.0.5
     * @param int $offset The offset is the expID for this instance.
     * @param string $expThing One of the following:  name, city, state, postition, startMonth, startYear, endMonth, endYear
     * @return string|int Returns the information requested about the experience instance.
     */
    public function getExpInfo($offset,$expThing) {
	return $this->exp->offsetGet($offset)->offsetGet($expThing);
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
    protected function setExpThing ($offset,$thing,$EXTexpName) {
	$this->exp->offsetGet($offset)->offsetSet($thing,$EXTexpName);
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
	$this->howManyRows = $sql->num_rows;
	$quickCount = 1;
	if ($this->howManyRows != 0) {
	    while($row = $sql->fetch_object()){
		$this->setExpID($quickCount);
		$this->exp->offsetSet($this->getExpID(),new ArrayObject());
		$this->setExpThing($this->getExpID(),'ID',$row->expID);
		$this->setExpThing($this->getExpID(),'name',$row->expName);
		$this->setExpThing($this->getExpID(),'city',$row->expCity);
		$this->setExpThing($this->getExpID(),'state',$row->expState);
		$this->setExpThing($this->getExpID(),'position',$row->expPosition);
		$this->setExpThing($this->getExpID(),'startMonth',$row->expStartMonth);
		$this->setExpThing($this->getExpID(),'startYear',$row->expStartYear);
		$this->setExpThing($this->getExpID(),'endMonth',$row->expEndMonth);
		$this->setExpThing($this->getExpID(),'endYear',$row->expEndYear);
		$this->setExpThing($this->getExpID(),'details',new ArrayObject());
		$quickCount++;
	    }
	}
    }

    /**
     * The Location of the Professional Experience
     *
     * This method exists to make life easier by combining city and state,
     * before it gets thought about by the expdetail class.
     *
     * @param int $offset The offset, secretly the expID for this instance.
     * @return string Returns the City, State for the Professional Experience
     */
    protected function expLocation($offset) {
	$city = $this->getExpInfo($offset, 'city');
	$state = $this->getExpInfo($offset, 'state');
	$location = $city . ", " . $state;
	return $location;
    }

    protected function showExpDate($offset){
	$smonth = $this->getExpInfo($offset,'startMonth');
	$syear = $this->getExpInfo($offset,'startYear');
	$emonth = $this->getExpInfo($offset,'endMonth');
	$eyear = $this->getExpInfo($offset,'endYear');
	

	if (($smonth == $emonth) && ($eyear == $eyear))  {
	    $daterange = $smonth . " " . $syear;
	}
	elseif (($emonth == null) || ($eyear == null)) {
	    $daterange = $smonth . " " . $syear . " &ndash; Present";
	}
	else {
	    $daterange = $smonth . " " . $syear . " &ndash; " . $emonth . " " . $eyear;
	}
	return $daterange;
    }
}
?>
