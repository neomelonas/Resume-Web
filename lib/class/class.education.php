<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.5
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
class Education implements Info {

    /**
     *
     * @var object Object of the Education class.
     */
    protected $ed;

    /**
     *
     * @var int Keeps track of something.
     */
    protected $sqlCounter;

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
    function __construct($dbcon,$userID) { 
	$this->ed = new ArrayObject();
	$this->fillDegree($dbcon,$userID);
    }

    /**
     * @since v3.0.1
     * @return int  Returns the specific instance of the Education class.
     */
    public function getEdInstance(){
	return $this->ed->offsetGet('ID')->key();
    }

    /**
     * Acquire various education information
     *
     * @since v3.0.4
     * @param int $offset What instance of education from where we want to get something.
     * @param string $thingToGet What thing from education we want to get.
     * @return int|string Returns the education information.
     */
    public function getInfo($offset,$thing){
	return $this->ed->offsetGet($offset)->offsetGet($thing);
    }

    /**
     *
     * @return int This method returns the number of lines in the fill method.
     */
    public function getSqlCounter() {
	return $this->sqlCounter;
    }

    /**
     * Here, we set the edInfo
     *
     * This is the method to set the education info in the ArrayObject.
     *
     * @param int $counter A counter for the thing's place in the Ed ArrayObject.
     * @param string $thing This is the name of what is being added to Education.
     * @param mixed $EXTecdID This is the data of what is being added.
     */
    public function setEdInfo ($counter,$thing,$EXTecdID) { 
	$this->ed->offsetGet($counter)->offsetSet($thing,$EXTecID);
    }

    /**
     * This method sets a way to find how many rows of data there are.
     *
     * @param int $sqlCount A count of the rows in the fill SQL statement
     */
    private function setSqlCounter($sqlCount) { $this->sqlCounter = $sqlCount; }


    /**
     * This function fills the Education Object with tasty data.
     *
     * @since v3.0.1
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    protected function fillDegree($dbcon, $userID) {
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
	$sql = $dbcon->query($sqlSQL);
	$counter = 0;
	$this->setSqlCounter(mysqli_num_rows($sql)-1);
	$this->howManyRows = $sql->num_rows;

	while($row = $sql->fetch_object()) {
	    $this->ed->offsetSet($counter,new ArrayObject());
	    $this->ed->offsetGet($counter)->offsetSet('ID',$row->ucID);
	    $this->ed->offsetGet($counter)->offsetSet('name',$row->edName);
	    $this->ed->offsetGet($counter)->offsetSet('city',$row->edCity);
	    $this->ed->offsetGet($counter)->offsetSet('state',$row->edState);
	    $this->ed->offsetGet($counter)->offsetSet('edStart',$row->edStart);
	    $this->ed->offsetGet($counter)->offsetSet('edEnd',$row->edEnd);
	    $this->ed->offsetGet($counter)->offsetSet('gradMonth',$row->gradMonth);
	    $this->ed->offsetGet($counter)->offsetSet('gradYear',$row->gradYear);
	    $this->ed->offsetGet($counter)->offsetSet('college', new ArrayObject());
	    $this->ed->offsetGet($counter)->offsetGet('college')->offsetSet('degree', $row->degreeName);
	    $this->ed->offsetGet($counter)->offsetGet('college')->offsetSet('major', new ArrayObject());
	    $this->ed->offsetGet($counter)->offsetGet('college')->offsetSet('minor', new ArrayObject());
	}
//	print_r($this->ed);
    }

    /**
     *
     * @since v3.0.4
     * @param int $offset What instance of education from which to graduate.
     * @return string Returns $graduation, the month and year of graduation.
     */
    public function graduation($offset) {
	$gmonth = $this->getInfo($offset, 'gradMonth');
	$gyear = $this->getInfo($offset, 'gradYear');

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
	$start = $this->getInfo($offset, 'start');
	$end = $this->getInfo($offset, 'end');

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
	$schoolCity = $this->getInfo($offset, 'city');
	$schoolState = $this->getInfo($offset, 'state');

	$schoolLocation = $schoolCity . ", " . $schoolState;
	return $schoolLocation;
    }
}
?>
