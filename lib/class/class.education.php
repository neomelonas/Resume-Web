<?php
/**
 * @package multiuser-resume
*/
/**
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.3
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 *
 */
class Education {

    /**
     *
     * @var object Object of the Education class.
     */
    protected $ed;
    protected $sqlCounter;
    protected $major = array();
    protected $minor = array();
    protected $gpa;
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
     * @since v3.0.0
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    function __construct($dbcon,$userID) { $this->ed = new ArrayObject();$this->major = new ArrayObject();$this->minor = new ArrayObject();$this->minor = new ArrayObject();$this->fillDegree($dbcon,$userID);}//$this->educationDisplay();}

    /**
     * @since v3.0.1
     * @return int  Returns the specific instance of the Education class.
     */
    public function getEdInstance(){
	return $this->ed->getIterator()->key();
    }

    /**
     * 
     * @since v3.0.4
     * @param int $offset What instance of education from where we want to get something.
     * @param string $thingToGet What thing from education we want to get.
     * @return int|string Returns the education information.
     */
    public function getEdInfo($offset,$thingToGet){
	return $this->ed->offsetGet($offset)->offsetGet($thingToGet);
    }

    public function getSqlCounter() {
	return $this->sqlCounter;
    }

    public function setEdInfo ($counter,$thing,$EXTecdID) { 
	$this->ed->offsetGet($counter)->offsetSet($thing,$EXTecID);
    }

    public function setCollege ($offset,$EXTcollege) { $this->college->offsetSet($offset,$EXTcollege); }

    private function setSqlCounter($sqlCount) { $this->sqlCounter = $sqlCount; }


    /**
     * This function fills the Education Object with tasty data.
     *
     * @since v3.0.1
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillDegree($dbcon, $userID) {
	$sqlSQL = "
	    SELECT `ucID`, `edName`, `edCity`, `edState`, `colName` ,
		`degreeName`, `edStart`, `edEnd`, `gradYear`, `gradMonth`
	    FROM res_education E
	    INNER JOIN res_user_ed UE on E.edID=UE.edID
	    INNER JOIN res_user_college UC on UE.ucID=UC.ecdID
	    INNER JOIN res_ed_col C on UC.colID=C.colID
	    INNER JOIN res_user_degree UD on UE.ucID=UD.ecdID
	    INNER JOIN res_ed_degree D on UD.degreeID=D.degreeID
	    WHERE UE.userID='".$userID."' ORDER BY `ucID` DESC
	";
	$counter = 0;
	$sql = $dbcon->query($sqlSQL);
	$this->setSqlCounter(mysqli_num_rows($sql)-1);
	$this->howManyRows = $sql->num_rows;
	$this->major = new ArrayObject();
	while($row = $sql->fetch_object()) {
	    $this->ed->offsetSet($counter,new ArrayObject());
	    $this->setEdInfo($counter, 'ID', $row->ucID);
	    $this->setEdInfo($counter, 'name', $row->edName);
	    $this->setEdInfo($counter, 'city', $row->edCity);
	    $this->setEdInfo($counter, 'state', $row->edState);
	    $this->setEdInfo($counter, 'start', $row->edStart);
	    $this->setEdInfo($counter, 'end', $row->edEnd);
	    $this->setEdInfo($counter, 'gradMonth', $row->gradMonth);
	    $this->setEdInfo($counter, 'gradYear', $row->gradYear);
	    $this->setEdInfo($counter, 'college', $row->colName);
	    $this->setEdInfo($counter, 'degree', $row->degreeName);
	    $this->setEdInfo($counter, 'major', new ArrayObject());
	    $this->setEdInfo($counter, 'minor', new ArrayObject());
	    print_r($this->ed);
	}
    }

    /**
     *
     * @since v3.0.4
     * @param int $offset What instance of education from which to graduate.
     * @return string Returns $graduation, the month and year of graduation.
     */
    public function graduation($offset) {
	$gmonth = $this->getEdInfo($offset, 'gradMonth');
	$gyear = $this->getEdInfo($offset, 'gradYear');

	$graduation = $gmonth . " " . $gyear;
	return $graduation;
    }

    /**
     *
     * @since v3.0.4
     * @param int $offset What instance of education from where we want to get something.
     * @return string Returns $schoolYears, which is the range of time for this instance of education.
     */
    public function schoolYears($offset){
	$start = $this->getEdInfo($offset, 'start');
	$end = $this->getEdInfo($offset, 'end');

	if (isset($end)){
	    $schoolYears = $start . " &ndash; " . $end;
	}
	else {
	    $schoolYears = $end;
	}
	return $schoolYears;
    }

    /**
     *
     * @since v3.0.4
     * @param int $offset What instance of education from where we want to get something.
     * @return string Returns $schoolLocation, the location of this instance of education.
     */
    public function schoolLocation($offset){
	$schoolCity = $this->getEdInfo($offset, 'city');
	$schoolState = $this->getEdInfo($offset, 'state');

	$schoolLocation = $schoolCity . ", " . $schoolState;
	return $schoolLocation;
    }
}
?>
