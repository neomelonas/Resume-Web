<?php
/*
 *	@project:	Resume-Web
 *	@branch:		multiuser
 *	@version:	v3.0.3
 *	@package multiuser-resume
 *	class.location.php
 */
class Location {
	private $locationID;
	private $street1;
	private $street2 = null;
	private $city;
	private $state;
	private $ZIP;
	private $locStatus;
	private $loc;
	
	// function __construct($locID, $locStreet, $locCity, $locState, $locZIP, $homeLoc) {$this->locationID = $locID; $this->street1 = $locStreet; $this->city = $locCity; $this->state = $locState; $this->ZIP = $locZIP; $this->locStatus = $homeLoc; }
	
	function __construct($dbname, $locStatus, $userID, $dbcon)
	{
		$this->locStatus = $locStatus;
		$this->populateLocation($dbname,$userID,$dbcon);
	}
	
	public function getLocID() { return $this->locationID; }
	public function getStreet() { return $this->street1; }
	public function getStreet2() { return $this->street2; }
	public function getCity() { return $this->city; }
	public function getState() { return $this->state; }
	public function getZIP() { return $this->ZIP; }
	public function getLocStatus() { return $this->locStatus; }
	public function getLoc() { return $this->loc; }
	
	public function setLocID($extLocID) { $this->locationID = $extLocID; }
	public function setLocStreet($extLocStreet) { $this->street1 = $extLocStreet; }
	public function setLocStreet2($extLocStreet2) { $this->street2 = $extLocStreet2; }
	public function setLocCity($extLocCity) { $this->city = $extLocCity; }
	public function setLocState($extLocState) { $this->state = $extLocState; }
	public function setLocZIP($extLocZIP) { $this->ZIP = $extLocZIP; }
	public function setLocStatus($extHomeLoc) { $this->locStatus = ord($extHomeLoc); $this->locStatus(); }
	private function setLoc($extLoc) { $this->loc = $extLoc; }
	
	public function locStatus() {
		$locStatus = $this->getLocStatus();
		if ($locStatus == 1) { $this->setLoc("Home: "); }
		else
		{ $this->setLoc("Local: "); }
	}
	
	public function populateLocation($dbname, $userID, $dbcon) {
		$sql = $dbcon->query("SELECT L.locID, `locStreet`, `locStreet2`, `locCity`, `locState`, `locZIP` FROM ".$dbname.".res_location L INNER JOIN ".$dbname.".res_user_loc UL on L.locID=UL.locID WHERE userID='" . $userID . "' AND homeLoc='".$this->getLocStatus()."'");
		if (!$sql) {echo "Bad SQL: "; echo "class.location " . $userID;}
		while ($row = $sql->fetch_object()) {
			$this->setLocID($row->locID);
			$this->setLocStreet($row->locStreet);
			if (isset($row->locStreet2)) { $this->setLocStreet2($row->locStreet2); }
			$this->setLocCity($row->locCity);
			$this->setLocState($row->locState);
			$this->setLocZIP($row->locZIP);
		}
	}
	
	
	public function locationDisplay() {
		if (!is_null($this->getLocID())){
			echo $this->getLoc() . "<span class='street'>" . $this->getStreet() . "</span> &bull; "; 
			echo $this->aSecondStreet() ;
			echo "<span class='city'>" . $this->getCity() . "</span>, <span class='state'>" . $this->getState() . "</span> <span class='zip'>" . $this->getZIP() . "</span>";
		}
	}
	public function aSecondStreet() { if ($this->getStreet2()) { echo "<span class='street'>" . $this->getStreet2() . "</span> &bull; "; } }
}
?>
