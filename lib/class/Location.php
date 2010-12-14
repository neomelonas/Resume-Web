<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
/**
 * The Location class provides support for users to be located somewhere.
 * @package resume-web
 * @subpackage multiuser-resume
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.1.0
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
class Location {
    /**
     * The location ID
     *
     * The unique identifier for a location.
     *
     * @var int Again, it is a unique ID for an instance of location.
     * @since v3.0.0
     */
    private $locationID;

    /**
     * street1
     *
     * The First Line of a Street Address
     *
     * @var string The primary line of the user's street address.
     */
    private $street1;

    /**
     * street2
     *
     * The second line of the user's street address.  Usually an apartment line.
     * It is allowed to be blank, since not everyone has a 2 line address.
     *
     * @var string The secondary (apartment) line of a street address.
     */
    private $street2 = null;

    /**
     * city
     *
     * The city line of the user's street address.
     *
     * @var string The city line of the street address.
     */
    private $city;

    /**
     * state
     *
     * The state line of the user's street address.
     *
     * @var string The state line of the street address.
     */
    private $state;

    /**
     * stateLong
     *
     * The long name of state line of the user's street address.
     *
     * @var string The long name of state line of the user's street address.
     */
    private $stateLong;

    /**
     * ZIP
     *
     * The ZIP code of a user's street address.
     *
     * @var int The ZIP code of the street address.
     */
    private $ZIP;

    /**
     * Country
     *
     * The country code of a user's street address.
     *
     * @var char The country code of the street address.
     */
     private $country;

    /**
     * locStatus
     *
     * The switch for the instance of the location.
     *
     * @var bool|int The location of the location (home/local/something).
     */
    private $locStatus;

    /**
     * loc
     *
     * The prefix for the instance of the location.
     *
     * @var string The location of the location (home/local).
     */
    public $loc;

    /**
     * This is the Class Constructor.
     *
     * It constructs the class.
     *
     * @param string $dbname
     * @param bool $locStatus
     * @param int $userID
     * @param object $dbcon
     */
    function __construct($dbname, $locStatus, $userID, $dbcon)
    {
	    $this->locStatus = $locStatus;
	    $this->fill($dbname,$userID,$dbcon);
	    $this->setStateLong($dbcon);
    }

    public function getLocID() { return $this->locationID; }
    public function getStreet() { return $this->street1; }
    public function getStreet2() { return $this->street2; }
    public function getCity() { return $this->city; }
    public function getState() { return $this->state; }
    public function getStateLong() { return $this->stateLong; }
    public function getZIP() { return $this->ZIP; }
    public function getCountry() { return $this->country; }
    public function getLocStatus() { return $this->locStatus; }
    public function getLoc() { return $this->loc; }

    private function setLocID($extLocID) { $this->locationID = $extLocID; }
    private function setLocStreet($extLocStreet) { $this->street1 = $extLocStreet; }
    private function setLocStreet2($extLocStreet2) { $this->street2 = $extLocStreet2; }
    private function setLocCity($extLocCity) { $this->city = $extLocCity; }
    private function setLocState($extLocState) { $this->state = $extLocState; }
    private function setLocZIP($extLocZIP) { $this->ZIP = $extLocZIP; }
    private function setLocCountry($extLocCountry) { $this->country = $extLocCountry; }

    /**
     * Set the location status (Home vs. Local)
     */
    public function place() {
	switch ($this->getLocStatus()) {
	    case 0;
		$place = "Local: ";
	        break;
	    case 1;
		$place = "Home: ";
		break;
	}
	return $place;
    }

    /**
     * Get the data for the Location class.
     *
     * @param string $dbname
     * @param int $userID
     * @param object $dbcon
     */
    public function fill($dbname, $userID, $dbcon) {
	$sql = $dbcon->query("
	    SELECT L.locID, `locStreet`, `locStreet2`, `locCity`, `locState`, `locZIP`, `locCountry`
	    FROM res_location L
	    INNER JOIN res_user_loc UL on L.locID=UL.locID
	    WHERE userID='".$userID."' AND homeLoc='".$this->getLocStatus()."'");
	if (!$sql) {echo "Bad SQL: "; echo "class.location " . $userID . "\nLocID: " . $this->getLocStatus() . "\n";}
	while ($row = $sql->fetch_object()) {
	    $this->setLocID($row->locID);
	    $this->setLocStreet($row->locStreet);
	    if (isset($row->locStreet2)) { $this->setLocStreet2($row->locStreet2); }
	    $this->setLocCity($row->locCity);
	    $this->setLocState($row->locState);
	    $this->setLocZIP($row->locZIP);
	    $this->setLocCountry($row->locCountry);
	}
    }

    /**
     * Show the location.
     */
    public function display() {
        $output='';
	if (!is_null($this->getLocID())){
	    $output = $this->place() . "<span class='street'>" . $this->getStreet() . "</span> &bull; ".$this->aSecondStreet()."<span class='city'>" . $this->getCity() . "</span>, <span class='state'>" . $this->getState() . "</span> <span class='zip'>" . $this->getZIP() . "</span>";
	}
        return $output;
    }

    /**
     * If there is a second street, like an apartment, it gets shown by this.
     */
    public function aSecondStreet() {
	if ($this->getStreet2()) {
	    return "<span class='street'>" . $this->getStreet2() . "</span> &bull; ";
	}
        else return false;
    }

    private function setStateLong($dbcon) {
	$sql = $dbcon->query("SELECT stateName FROM states WHERE stateID='". $this->state ."'");
	while($row = $sql->fetch_object()){
	    $stateLong = $row->stateName;
	}
	$stateLong = ucfirst(strtolower($stateLong));
	$this->stateLong = $stateLong;
    }
}
?>
