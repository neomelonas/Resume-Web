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
 * @copyright 2009-2010 Neo Melonas
 *
 * @todo MAKE THINGS WORK x_x
 */
class  Focus extends Education {

    /**
     * This is the Education Constructor.
     *
     * It constructs education.  Sort of.
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user's identification.
     */
    function __construct($dbcon,$userID) {
	$this->fillMajors($dbcon, $userID);
    }

    public function getMajorInfo($offset){
	return $this->ed->offsetGet($offset)->offsetGet('major')->getIterator();
    }

    /**
     *
     * @param <type> $offset
     * @param <type> $focus
     * @param <type> $gpa
     */
    private function setMajorInfo($offset, $focus, $gpa){
	$this->ed->offsetGet($offset)->offsetGet('major')->offsetSet($focus, $gpa);
    }
    
    private function fillMajors($dbcon,$userID){
	$counter = 1;
	$sql = $dbcon->query("
	    SELECT `majorName`, `gpa`
	    FROM res_ed_major M
	    INNER JOIN res_user_major UM on M.majorID=UM.majorID
	    INNER JOIN res_user_ed UE on UM.ecdID=UE.ucID
	    WHERE UE.userID='". $userID ."'
	");
	while($row = $sql->fetch_object()){
	    $this->setMajorInfo($counter, $row->majorName, $row->gpa);
	    $counter++;
	}
    }

    public function displayMajors($offset){
	$iter = $this->getMajorInfo($offset);
	while($iter->valid()){
	    echo $iter->key() . " : " . $iter->current();
	    $iter->next();
	}

    }

    public function displayEd(){
	$counter = 1;
	while ($counter <= ($this->howManyRows)){
	    $this->get
	}
    }
}
?>