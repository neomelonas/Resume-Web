<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
/**
 * Course lists the different relevant coursework attributed to the user.
 * @package resume-web
 * @subpackage multiuser-resume
 * @author Neo Melonas
 * @version 3.1.0
 * @since 3.0.6
 * @copyright 2010 Neo Melonas
 */
class Course {
    /**
     *
     * @var object
     */
    public $courses;

    /**
     *
     * @param object $dbcon
     * @param int $userID
     */
    function __construct($dbcon, $userID) {
	$this->courses = new ArrayObject();
	$this->fillCourse($dbcon, $userID);
    }

    /**
     *
     * @param int $offset
     * @param string $info
     * @return string|int
     */
    public function getInfo($offset,$info){
	return $this->courses->offsetGet($offset)->offsetGet($info);
    }

    /**
     *
     * @param object $dbcon
     * @param int $userID
     */
    private function fillCourse($dbcon, $userID){
	$sql = $dbcon->query("
	    SELECT c.rcID, `rcCourseName`, `rcCourseNum`, `rcCourseDesc`
	    FROM res_courses c
	    INNER JOIN res_user_rc rc ON c.rcID=rc.rcID
	    WHERE userID='" . $userID . "'
	");
	while($row = $sql->fetch_object()){
	    $this->courses->offsetSet($row->rcID, new ArrayObject());
	    $this->courses->offsetGet($row->rcID)->offsetSet('name',$row->rcCourseName);
	    $this->courses->offsetGet($row->rcID)->offsetSet('num',$row->rcCourseNum);
	    $this->courses->offsetGet($row->rcID)->offsetSet('desc',$row->rcCourseDesc);
	}
    }

    /** This method does Course display. */
    public function display(){
	$iter = $this->courses->getIterator();
	echo "<ul>";
	while($iter->valid()){
	    $offset = $iter->key();
	    echo "<li>";
	    if ($this->getInfo($offset, 'name') != ""){
		echo $this->getInfo($offset, 'name');
	    }
	    if ($this->getInfo($offset, 'num') == ""){
		if ($this->getInfo($offset, 'name') != ""){
		    echo ": ";
		}
	    }
	    else {
		echo " " . $this->getInfo($offset, 'num') . ": ";
	    }
	    echo $this->getInfo($offset, 'desc');echo "</li>";
	    $iter->next();
	}
	echo "</ul>";
    }
}
?>