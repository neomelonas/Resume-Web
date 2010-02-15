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
class Education {
    private $ed;
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
		`gradMonth`, `gradYear`
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
	    $arr = new ArrayObject (
		$array = array(
		'ID'=>$row->ucID,
		'edName'=>$row->edName,
		'edCity'=>$row->edCity,
		'edState'=>$row->edState,
		'edStart'=>$row->edStart,
		'edEnd'=>$row->edEnd,
		'gradMonth'=>$row->gradMonth,
		'gradYear'=>$row->gradYear
	    ));
	    $this->ed->offsetSet($counter, $arr);
	}
    }

    public function display(){
	$iter = $this->ed->getIterator();
	while($iter->valid()){
	    $this->getInfo($iter->key(), 'ID');
	    $iter2 = $this->ed->offsetGet($iter->key())->getIterator();
	    $chalk = $this->ed->offsetGet($iter->key());
	    while ($iter2->valid()){
		echo $iter2->key() . ": " . $iter2->current() . "<br/>";
		$iter2->next();
	    }
	    echo "\n";
	    $iter->next();
	}
    }

    public function edTimeSpan($offset){
	$span =  $this->getInfo($offset,'edStart');
	if (!is_null($this->getInfo($offset,'edEnd'))){
	    if ($this->getInfo($offset,'edStart') != $this->getInfo($offset,'edEnd')){
		$span = $span . " &ndash; ";
	    }
	}
	else { $span = $span . " &ndash; Present"; }
	return $span;
    }

    public function displayLocation($offset){
	$span = $this->getInfo($offset, 'edCity');
	$span = $span . ", ";
	$span = $span . $this->getInfo($offset, 'edState');
	return $span;
    }
}
?>
