<?php
class Education {
/**
 *	@package multiuser-resume
 *	@author neomelonas
 *	@version v3.0.3
 */
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
	
	function __construct($dbcon,$userID,$ecdID) { $this->setDBCON($dbcon);$this->ed = new ArrayObject();$this->major = new ArrayObject();$this->minor = new ArrayObject();$this->minor = new ArrayObject();$this->fillDegree($dbcon,$userID);}//$this->educationDisplay();}
	
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
	
	//
	public function setDBCON($DBCONZ) { $this->dbcon = $DBCONZ; }
	//
	
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
	
	private function fillDegree($dbcon, $userID) {
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

			$majSQL = $dbcon->query("SELECT majorName, gpa FROM res_ed_major M INNER JOIN res_user_major UM ON M.majorID=UM.majorID INNER JOIN res_user_ed UE ON UM.ecdID=UE.ucID 
			WHERE ucID='".$this->ed->offsetGet($counter)->offsetGet(ID)."'
			");
			while($row = $majSQL->fetch_object()) {
				if (isset($row->gpa)) { $gpa = $row->gpa; } else { $gpa = 0; }
				$this->major->offsetSet($row->majorName,$row->gpa);
			}
//			print_r($this->major);
			$counter++;
		}
	}
		
	public function displayEd() {
		for($count=0;$count<=$this->getSqlCounter();$count++) {
			$iter = $this->ed->offsetGet($count)->getIterator();
			while($iter->valid()) {
				echo "{$iter->key()} : {$iter->current()} <br />";
				$iter->next();
			}
		}
	}
}
?>
