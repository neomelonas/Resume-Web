<?php
/**
 *	@project Resume-Web
 *	@branch multiuser
 *	@package multiuser-resume
 *	@author neomelonas
 *	@version v3.0.3
 *	class.phone.php
 */
class Phone extends User{
	private $area;
	private $zone;
	private $local;
	private $type;
	private $pref;
	
	function __construct($dbcon, $user, $pref) { $this->fillANumber($dbcon,$this->userID,$pref); }
	
	// Gets
	public function getArea () { return $this->area; }
	public function getZone () { return $this->zone; }
	public function getLocal () { return $this->local; }
	public function getType () { return $this->type; }
	public function getPref () { return $this->pref; }
	
	// Sets
	public function setArea ($EXTarea) { $this->area = $EXTarea; }
	public function setZone ($EXTzone) { $this->zone = $EXTzone; }
	public function setLocal ($EXTlocal) { $this->local = $EXTLocal; }
	public function setType ($EXTtype) { $this->type = $EXTtype; }
	public function setPref ($EXTpref) { $this->pref = $EXTpref; }
	
	//Let's get things rollin'.
	private function fillANumber ($dbcon, $userID, $pref) {
		$sql = $dbcon->query("SELECT phArea, phZone, phLocal, phType FROM res_phone WHERE userID='" . $userID . "'
		");
		while($row = $sql->fetch_object()){
			$this->setArea($row->phArea);
			$this->setZone($row->phZone);
			$this->setLocal($row->phLocal);
			$this->setType($row->phType);
			$this->setPref(ord($row->prefPhone));
		}
	}
	public function showPhone(){
		$phone = null;
		if ($this->getPref() == 1) {
			$phone = "(" . $this->getArea() .  ") " . $this->getZone() . "-" . $this->getLocal()."&bull;";
		}
		return $phone;
	}
}
?>
