<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * The Location class provides support for users to be located somewhere.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
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
     * ZIP
     *
     * The ZIP code of a user's street address.
     *
     * @var int The ZIP code of the street address.
     */
    private $ZIP;

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
    public function populateLocation($dbname, $userID, $dbcon) {
	    $sql = $dbcon->query("
		SELECT L.locID, `locStreet`, `locStreet2`, `locCity`, `locState`, `locZIP`
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
	    }
    }

    /**
     * Show the location.
     */
    public function display() {
	    if (!is_null($this->getLocID())){
		    echo $this->place() . "<span class='street'>" . $this->getStreet() . "</span> &bull; ";
		    echo $this->aSecondStreet() ;
		    echo "<span class='city'>" . $this->getCity() . "</span>, <span class='state'>" . $this->getState() . "</span> <span class='zip'>" . $this->getZIP() . "</span>";
	    }
    }

    /**
     * If there is a second street, like an apartment, it gets shown by this.
     */
    public function aSecondStreet() {
	if ($this->getStreet2()) {
	    echo "<span class='street'>" . $this->getStreet2() . "</span> &bull; ";
	}
    }
}
?>
