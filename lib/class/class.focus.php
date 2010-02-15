<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * The Focus class extends the Education class, and enables the
 * user to have majors and minors.  Eventually.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.3
 * @since v3.0.3
 * @copyright 2009-2010 Neo Melonas
 *
 * @todo MAKE THINGS WORK x_x
 */
class Focus extends Education implements Info, Display {

    /**
     * This is the Education Constructor.
     *
     * It constructs education.  Sort of.
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user's identification.
     */

    function __construct($dbcon,$userID) {
	parent::__construct($dbcon, $userID);
	$this->fillMajors($dbcon, $userID);
    }

    public function getInfo($offset,$thing){
	switch ($thing){
	    case 'college':
		return $this->ed->offsetGet($offset)->offsetGet('college')->getIterator();
		break;
	    case 'degree':
		return $this->ed->offsetGet($offset)->offsetGet('college')->offsetGet('degree')->getIterator();
		break;
	    case 'major':
		return $this->ed->offsetGet($offset)->offsetGet('college')->offsetGet('degree')->offsetGet('major')->getIterator();
		break;
	    case 'minor':
		return $this->ed->offsetGet($offset)->offsetGet('college')->offsetGet('degree')->offsetGet('minor')->getIterator();
		break;
	    default:
		parent::getInfo($offset, $thing);
		break;
	}
    }

//    private function setInfo($offset, $thing, $EXTinfo){
//	$this->ed->offsetGet($offset)->offsetGet('college')->getIterator();
//    }


    private function fillMajors($dbcon,$userID){
	$counter = 0;
	$sql = $dbcon->query("
	    SELECT `ucID`, `majorName`, `gpa`
	    FROM res_ed_major M
	    INNER JOIN res_user_major UM on M.majorID=UM.majorID
	    INNER JOIN res_user_ed UE on UM.ecdID=UE.ucID
	    WHERE UE.userID='". $userID ."'
	");
	while($row = $sql->fetch_object()){
	    //$this->ed->offsetGet($counter)->offsetGet('college')->offsetGet('degree')->offsetGet('major')->getIterator()->offsetSet($row->majorName, $row->gpa);
	    $counter++;
	}
    }


    public function display(){
	$iter = $this->ed->getIterator();
	while($iter->valid()){
	    echo $this->getInfo($iter->key(), 'name');
	    echo $this->getInfo($iter->key(), 'college')->key();
	    $iter->next();
	}
    }
}
?>