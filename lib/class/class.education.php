<?php
/**
 * @package multiuser-resume
 */
/**
 * The Education class provides support for education instances.
 *
 * @author neomelonas
 * @version v3.0.3
 * @since v3.0.1
 */
class Education {

    protected $ed;
    private $ecdID;
    private $edName;
    private $edCity;
    private $edState;
    private $edStart;
    private $edEnd;
    private $gradMonth;
    private $gradYear;
    protected $degreeID;
    protected $degreeName;
    protected $college;
    private $sqlCounter;
    protected $major = array();
    protected $minor = array();
    protected $gpa;

    function __construct($dbcon,$userID) { $this->fillDegree($dbcon,$userID);}

    public function getEdInstance () { return $this->ed->getIterator()->key(); }
    public function getEdID () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(ID); }
    public function getEdName () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(name); }
    public function getEdCity () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(city); }
    public function getEdState () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(state); }
    public function getDegree () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(degree); }
    public function getEdStart () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(start); }
    public function getEdEnd () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(end); }
    public function getGradMonth () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(gradMonth); }
    public function getGradYear () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(gradYear); }
    public function getCollege () { return $this->ed->offsetGet($this->getEdInstance())->offsetGet(college); }
    public function getSqlCounter() { return $this->sqlCounter; }


    public function setEd ($offset,$EXTed) { $this->ed->offsetSet($offset,$EXTed); }
    public function setEdID ($counter,$EXTecdID) { $this->ecdID = $EXTecdID; $this->ed->offsetGet($counter)->offsetSet('ID',$EXTecID);}
    public function setEdName ($extEdName) { $this->edName = $extEdName; }
    public function setEdCity ($extEdCity) { $this->edCity = $extEdCity; }
    public function setEdState ($extEdState) { $this->edState = $extEdState;}
    public function setDegreeID ($extDegreeID) { $this->degreeID = $extDegreeID; }
    public function setDegree ($extDegreeName) { $this->degree = $extDegreeName; }
    public function setEdStart ($extEdStart) { $this->edStart = $extEdStart; }
    public function setEdEnd ($extEdEnd) { $this->edEnd = $extEdEnd; }
    public function setGradMonth ($extGradMonth) { $this->gradMonth = $extGradMonth; }
    public function setGradYear ($extGradYear) { $this->gradYear = $extGradYear; }
    public function setCollege ($offset,$EXTcollege) { $this->college->offsetSet($offset,$EXTcollege); }
    private function setSqlCounter($sqlCount) { $this->sqlCounter = $sqlCount; }

    protected function fillDegree($dbcon, $userID) {
	$this->ed = new ArrayObject();
        $sqlSQL = "
			SELECT `ucID`, `edName`, `edCity`, `edState`, `colName` , `degreeName`, `edStart`, `edEnd`, `gradYear`, `gradMonth` 
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
        $this->major = new ArrayObject();
        while($row = $sql->fetch_object()) {
            $this->setEd($counter,new ArrayObject());
            $this->ed->offsetGet($counter)->offsetSet('ID',$row->ucID);
            $this->ed->offsetGet($counter)->offsetSet('name',$row->edName);
            $this->ed->offsetGet($counter)->offsetSet('city',$row->edCity);
            $this->ed->offsetGet($counter)->offsetSet('state',$row->edState);
            $this->ed->offsetGet($counter)->offsetSet('start',$row->edStart);
            $this->ed->offsetGet($counter)->offsetSet('end',$row->edEnd);
            $this->ed->offsetGet($counter)->offsetSet('gradMonth',$row->gradMonth);
            $this->ed->offsetGet($counter)->offsetSet('gradYear',$row->gradYear);
            $this->ed->offsetGet($counter)->offsetSet('college',$row->colName);
            $this->ed->offsetGet($counter)->offsetSet('degree',$row->degreeName);

	    $this->ed->offsetGet($counter)->offsetSet('majors',new ArrayObject());

            $counter++;
        }
    }
    public function showEd() {
        echo "<section id=\"ed-".$this->ed->offsetGet($this->getEdInstance())->offsetGet(ID)."\">";
        echo "<span class=\"school\">".$this->ed->offsetGet($this->getEdInstance())->offsetGet(name)."</span>";
        echo "<span class=\"timeframe\">" . $this->ed->offsetGet($this->getEdInstance())->offsetGet(start);
        if (is_null($this->ed->offsetGet($this->getEdInstance())->offsetGet(end))) {
            echo " &ndash Present</span>";
        }
        else {
            if ($this->getEdInstance()->offsetGet(end) == $this->getEdInstance()->offsetGet(start)) {
                echo "</span>";
            }
            echo " &ndash; ";
            echo $this->ed->offsetGet($this->getEdInstance())->offsetGet(end);
        }
        echo "<br />";
        echo "<span class=\"colName\">". $this->ed->offsetGet($this->getEdInstance())->offsetGet(college) ."</span>";
        echo "<br />";
        echo "<span class=\"degree\">". $this->ed->offsetGet($this->getEdInstance())->offsetGet(degree) ."</span>";
        echo "</section>";
    }
}
?>
