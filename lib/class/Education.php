<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * The Education Class hurts people's heads.
 * @package resume-web
 * @subpackage multiuser-resume
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.1.0
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
class Education {
    protected $ed;
    protected $howManyRows;

    function __construct($dbcon, $userID) {
	$this->ed = new ArrayObject();
	$this->fill($dbcon, $userID);
    }

    public function freeIter(){
	return $this->ed->getIterator();
    }
    public function subIter($offset){
	return $this->ed->offsetGet($offset)->getIterator();
    }

    
    public function getInfo ($offset,$thing){
	if ($this->ed->offsetExists($offset)){
	    $abitch = $this->ed->offsetGet($offset);
	    if ($abitch->offsetExists($thing)){
		return $abitch->offsetGet($thing);
	    }
	}
    }

    /**
     * The method fill populates the data for the resume.
     *
     * fill has its roots in the Info factory class.
     *
     * @param object $dbcon The databse connection object.
     * @param int $userID The user ID that the resume is about.
     * @internal
     */
    private function fill($dbcon, $userID) {
	$sql = $dbcon->query("
	    SELECT `ucID`, `edName`, `edCity`, `edState`, `edStart`, `edEnd`,
		`gradMonth`, `gradYear`, `other`
	    FROM res_user_ed ue
	    INNER JOIN res_education e ON ue.edID=e.edID
	    WHERE ue.userID='" . $userID . "'
	    ORDER BY gradYear DESC
	");
	$this->howManyRows = $sql->num_rows;
	$counter = 0;
	$count = array ();
	while($row = $sql->fetch_object()){
	    $counter++;
	    array_push($count, $counter);
		$college = $this->fillCollege($dbcon, $userID, $row->ucID);
		$degree = $this->fillDegree($dbcon, $userID, $row->ucID);
		$major = $this->fillMajors($dbcon, $userID, $row->ucID);
		$minor = $this->fillMinors($dbcon, $userID, $row->ucID);
	    $arr = new ArrayObject (
		$array = array(
		'ID'=>$row->ucID,
		'edName'=>$row->edName,
		'edCity'=>$row->edCity,
		'edState'=>$row->edState,
		'edStart'=>$row->edStart,
		'edEnd'=>$row->edEnd,
		'gradMonth'=>$row->gradMonth,
		'gradYear'=>$row->gradYear,
		'other'=>$row->other,
		'college'=>$college,
		'degree'=>$degree,
		'major'=>$major,
		'minor'=>$minor
	    ));
	    $this->ed->offsetSet($counter, $arr);
	}
    }
    
    private function fillMajors($dbcon, $userID, $ecdID){
	$majors = array();
	$sql = $dbcon->query("
	    SELECT `majorName`, `gpa`
	    FROM res_ed_major M
	    INNER JOIN res_user_major UM on M.majorID=UM.majorID
	    INNER JOIN res_user_ed UE on UM.ecdID=UE.ucID
	    WHERE UE.userID='". $userID ."' AND ecdID='". $ecdID ."'
	    ORDER BY gpa
	");
	while($row = $sql->fetch_object()){
	    $majors[$row->majorName] = $row->gpa;
	}
	$major = new ArrayObject($majors);
	return $major;
    }
    private function fillMinors($dbcon, $userID, $ecdID){
	$minors = array();
	$sql = $dbcon->query("
	    SELECT `minorName`
	    FROM res_ed_minor M
	    INNER JOIN res_user_minor UM on M.minorID=UM.minorID
	    INNER JOIN res_user_ed UE on UM.ecdID=UE.ucID
	    WHERE UE.userID='". $userID ."' AND ecdID='". $ecdID ."'
	");
	while($row = $sql->fetch_object()){
	    array_push($minors,$row->minorName);
	}
	$minor = new ArrayObject($minors);
	return $minor;
    }

    private function fillDegree($dbcon, $userID, $ecdID){
	$degrees = array();
	$sql = $dbcon->query("
	    SELECT `degreeName`
	    FROM res_ed_degree d
	    INNER JOIN res_user_degree ud ON d.degreeID=ud.degreeID
	    INNER JOIN res_user_ed ue ON ud.ecdID=ue.ucID
	    WHERE userID='". $userID ."' AND ucID='". $ecdID ."'
	");
	while($row = $sql->fetch_object()){
	    array_push($degrees,$row->degreeName);
	}
	$degree = new ArrayObject($degrees);
	return $degree;
    }

    private function fillCollege($dbcon, $userID, $ecdID){
	$colleges = array();
	$sql = $dbcon->query("
	    SELECT ec.colID, `colName`
	    FROM res_ed_col ec
	    INNER JOIN res_user_college uc ON ec.colID=uc.colID
	    INNER JOIN res_user_ed ue ON uc.ecdID=ue.ucID
	    WHERE userID='". $userID ."' and ucID='". $ecdID ."'
	");
	while($row = $sql->fetch_object()){
	    $colleges[$row->colID] = $row->colName;
	}
	$college = new ArrayObject($colleges);
	return $college;
    }

    public function edTimeSpan($offset){
	$span =  $this->getInfo($offset,'edStart');
	if (!is_null($this->getInfo($offset,'edEnd'))){
	    if ($this->getInfo($offset,'edStart') != $this->getInfo($offset,'edEnd')){
		$span = $span . " &ndash; " . $this->getInfo($offset, 'edEnd');
	    }
	}
	else { $span = $span . " &ndash; Present"; }
	return $span;
    }

    public function edLocation($offset){
	$span = $this->getInfo($offset, 'edCity');
	$span = $span . ", ";
	$span = $span . $this->getInfo($offset, 'edState');
	return $span;
    }

    public function edGrad($offset){
	$span = $this->getInfo($offset, 'gradMonth');
	$span = $span . " ";
	$span = $span . $this->getInfo($offset, 'gradYear');
	return $span;
    }


    public function focus($offset,$focus){
	return $this->ed->offsetGet($offset)->offsetGet($focus)->getIterator();
    }

    public function display(){
	$iter = $this->ed->getIterator();
	while($iter->valid()){
	    $itercol = $this->focus($iter->key(), 'college');
	    $itermajor = $this->focus($iter->key(), 'major');
	    $iterminor = $this->focus($iter->key(), 'minor');
	    $major = "";
	    $counterC = 0;
	    $counterM1 = 0;
	    $counter = 0;
	    $gpa = 0;
	    
	    while($itercol->valid()){
	    	$collegeI = $itercol->key() . "|";
	    	$collegeN = $itercol->current() . "|";
	    	$counterC++;
	    	$itercol->next();
	    }
	    if (isset($collegeI)){
		$collegeI = explode("|", $collegeI);
	    }
	    if (isset($collegeN)){
		$collegeN = explode("|", $collegeN);
	    }
	    if ($collegeI[0] !== 'Array'){
		$college = "<span class=\"colID" . $collegeI[0] . "\">" . $collegeN[0] . "</span>";
	    }
	    else { $college = null; }
	    while($itermajor->valid()){
	    	$major = $itermajor->key() . "|" . $major;
	    	if ($itermajor->current() > $gpa){
	    	    $gpa = $itermajor->current();
	    	}
	    	$counterM1++;
	    	$itermajor->next();
	    }
	    switch ($counterM1){
	    	case 1:
	    	    $major = explode("|",$major);
	    		$major = "Major: " . $major[0];
	    	    break;
	    	case 2:
	    	    $major = explode("|",$major);
	    	    $major = "Dual Major: " . $major[0] . " & " . $major [1];
	    	    break;
	    	case 3:
	    	    $major = explode("|",$major);
	    	    $major = "Triple Major: " . $major[0] . ", " . $major[1] . ", & " . $major[2];
	    	    break;
		default:
		    $major = null;
		    break;
	    }
	    while($iterminor->valid()){
		$minor = $iterminor->current() . "|" . $minor;
		$counter++;
		$iterminor->next();
	    }
	    switch ($counter){
		case 1:
		    $minor = explode("|",$minor);
		    $minor = "Minor: " . $minor[0];
		    break;
		case 2:
		    $minor = explode("|",$minor);
		    $minor = "Dual Minor: " . $minor[0] . " & " . $minor [1];
		    break;
		case 3:
		    $minor = explode("|",$minor);
		    $minor = "Triple Minor: " . $minor[0] . ", " . $minor[1] . ", & " . $minor[2];
		    break;
	    }
	    echo "
	    <article class=\"ed-" . $this->getInfo($iter->key(), 'ID') ." educate\">
		<section class=\"col1\">
		    <p class=\"school\">". $this->getInfo($iter->key(), 'edName') ."</p>
		    <p class=\"college\">". $college ."</span>
		    <p class=\"degree\">". $this->getInfo($iter->key(), 'degree')->getIterator()->current() ."</p>
		    <p class=\"majors\">". $major ."</p>
		    <p class=\"minors\">". $minor ."</p>
		    <p class=\"others\">". $this->getInfo($iter->key(), 'other') ."</p>
		</section>
		<section class=\"col2\">
		    <p class=\"loc\">". $this->edLocation($iter->key()) ."</p>
		</section>
		<section class=\"col3\">
		    <p class=\"timespan\">". $this->edTimeSpan($iter->key()) ."</p>";
		    if (($this->getInfo($iter->key(),'gradYear') !=  $this->getInfo($iter->key(), 'edEnd'))
			&& $this->getInfo($iter->key(),'gradYear') != null){
			echo "<p class=\"grad\">Graduation: ". $this->edGrad($iter->key()) ."</p>";
		    }
		    if ($gpa != 0 || $gpa != null) {echo "<p class=\"gpa\">GPA: " . $gpa . "</p>"; }
		echo "</section>
	    </article>";
	    $iter->next();
	}
    }
}
?>
