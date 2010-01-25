<?php
/**
 *	@project Resume-Web
 *	@branch multiuser
 *	@package multiuser-resume
 *	@author neomelonas
 *	@version v3.0.3
 *	class.intact.php
 */
class IntAct {
	private $ia;
	private $inputID;
	
	function __construct($dbcon,$userID) {
		$this->ia = new ArrayObject();
		$this->fillIA($dbcon,$userID);
	}

	function __destruct() {}
	
	public function getIa($iter) {
		if($this->ia-offsetExists($iter)) {
			return $this->ia->offsetGet($iter);
		}
	}
	public function getIaInputID() { return $this->inputID; }
	
	public function setIa($offset,$EXTiaDesc) { $this->ia->offsetSet($offset,$EXTiaDesc); }
	private function setIaWeight($EXTiaWeight) { $this->iaWeight->append($EXTiaWeight); }
	private function setIaInputID($EXTiaInuputID) { $this->inputID = $EXTiaInputID; }
	
	public function fillIA($dbcon,$userID) {
		$this->ia = new ArrayObject();
		$this->iaWeight = new ArrayObject();
		$sql = $dbcon->query("SELECT I.iaID, `iaDesc`, `inputingUserID` FROM res_intact I INNER JOIN res_user_ia UIA on I.iaID=UIA.iaID WHERE userID='". $userID ."' ORDER BY `iaWeight` DESC");
		while($row = $sql->fetch_object()) {
			$this->setIa($row->iaID,$row->iaDesc);
			$this->setIaInputID($row->inputingUserID);
		}
	}
	
	public function displayIA() {
		$iter = $this->ia->getIterator();
		echo "<ul>";
		while($iter->valid()) {
			echo "<li class=\"{$iter->key()}\">{$iter->current()}</li>";
			$iter->next();
		}
		echo "</ul>";
	}
}
?>
