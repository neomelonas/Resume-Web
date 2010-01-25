<?php
/*
 *	@project:	Resume-Web
 *	@branch:		multiuser
 *	@version:	v3.0.3
 *	@package multiuser-resume
 *	class.technology.php
 */
class Technology {
	private $teCount;
	private $languages = array();
	private $systems = array();
	private $programs = array();
	private $other = array();
	private $noGroup = array();
	
	function __construct($dbcon,$userID, $groups) {
		if($groups == 1) {
			$this->fillTechLang($dbcon,$userID);
			$this->fillTechSys($dbcon,$userID);
			$this->fillTechProg($dbcon,$userID);
			$this->fillTechOther($dbcon,$userID);
		}
		elseif($groups==0)
		{ $this->fillTechNoGroup($dbcon,$userID); }
		else  die('Pick a Resume Type, please.') ;
	}
	
	public function getTeCount() { return $this->teCount; }
	public function getLanguages() { return $this->languages; }
	public function getSystems() { return $this->systems; }
	public function getPrograms() { return $this->programs; }
	public function getOther() { return $this->other; }
	
	public function setTeCount($EXTteCount) { $this->teCount = $EXTteCount; }
	public function setLanguages($EXTte,$EXTlanguages) { $this->languages[$EXTte] = $EXTlanguages; }
	public function setSystems($EXTte,$EXTsystems) { $this->systems[$EXTte] = $EXTsystems; }
	public function setPrograms($EXTte,$EXTprograms) { $this->programs[$EXTte] = $EXTprograms; }
	public function setOther($EXTte,$EXTother) { $this->other[$EXTte] = $EXTother; }
	
	private function fillTechLang($dbcon,$userID) {
		$this->languages = new ArrayObject(array());
		$sql = $dbcon->query("SELECT TE.teID, `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='language'");
		while($row = $sql->fetch_object()) {
			$this->languages->append($row->teDesc);
		}
	}
	private function fillTechSys($dbcon,$userID) {
		$this->systems = new ArrayObject();
		$sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='OS'");
		while($row = $sql->fetch_object()) {
			$this->systems->append($row->teDesc);
		}
	}
	private function fillTechProg($dbcon,$userID) {
		$this->programs = new ArrayObject();
		$sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='program'");
		while($row = $sql->fetch_object()) {
			$this->programs->append($row->teDesc);
		}
	}
	private function fillTechOther($dbcon,$userID) {
		$this->other = new ArrayObject();
		$sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='other'");
		while($row = $sql->fetch_object()) {
			$this->other->append($row->teDesc);
		}
	}
	private function fillTechNoGroup($dbcon,$userID) {
		$this->noGroup = new ArrayObject();
		$sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='nogroup'");
		while($row = $sql->fetch_object()) {
			$this->noGroup->append($row->teDesc);
		}
	}	
	public function quickDisplay($groups) {
		if($groups==1) {
			$this->displayLang();
			$this->displaySys();
			$this->displayProg();
			$this->displayOther();
		}
		elseif($groups==0)
		{ $this->displayNoGroup(); }
		else  die('Pick a Resume Type, please.');
	}
	public function displayLang() {
		$iterator = $this->languages->getIterator();
		echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Languages: </span></li>";
		while($iterator->valid()) {
			echo "<li>{$iterator->current()};  \n</li>";
			$iterator->next();
		}
		echo "</ul>";
	}
	public function displaySys() {
		$iterator = $this->systems->getIterator();
		echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Operating Systems: </span></li>";
		while($iterator->valid()) {
			echo "<li>{$iterator->current()};  \n</li>";
			$iterator->next();
		}
		echo "</ul>";
	}
	public function displayProg() {
		$iterator = $this->programs->getIterator();
		echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Programs: </span></li>";
		while($iterator->valid()) {
			echo "<li>{$iterator->current()};  \n</li>";
			$iterator->next();
		}
		echo "</ul>";
	}
	public function displayOther() {
		$iterator = $this->other->getIterator();
		echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Other: </span></li>";
		while($iterator->valid()) {
			echo "<li>{$iterator->current()}</li>";
			$iterator->next();
		}
		echo "</ul>";
	}
	public function displayNoGroup() {
		$iterator = $this->noGroup->getIterator();
		echo "<ul class=\"techDetails\">";
		while($iterator->valid()) {
			echo "<li>{$iterator->current()};  \n</li>";
			$iterator->next();
		}
		echo "</ul>";
	}
}
?>
