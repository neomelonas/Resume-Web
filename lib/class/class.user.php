<?php
/**
 * @package multiuser-resume
 */

/**
 * User is the class that allows users to exist.
 *
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
class User {
    /**
     * The user identifier.
     * @var int
     */
    private $userID;
    private $userFName;
    private $userMName;
    private $userLName;
    private $MaN;

    private $userEmail;
    private $password;
    private $userName;
    private $userSlug;

    // Don't forget data_user
    private $dataDateCreated;
    private $dataLastUpdate;
    private $dataClickCount;
    private $dataFeatured;

    /**
     * The phone number, seperated by dashes (-)
     * @var string
     */
    private $phone;

    /**
     * This is the Class Constructor.
     *
     * It constructs the class.
     *
     * @param int $userID
     * @param string $dbname
     * @param object $dbcon
     */
    function __construct($userID, $dbname, $dbcon) {
	    $this->userID = $userID;
	    $this->populateUser($dbname, $dbcon);
	    //$this->anotherPageView($dbname, $dbcon);
    }
    /**
     * Class destructor, kills off the class when stuff is done.
     */
    function __destruct() {}

    // Gets
    public function getUserID() { return $this->userID; }
    public function getUserFName() { return $this->userFName; }
    public function getUserMName() { return $this->userMName; }
    public function getUserLName() { return $this->userLName; }
    public function getUserMaN() { return $this->MaN; } // middleASnick
    public function getUserEmail() { return $this->userEmail; }
    public function getUserPassword() { return $this->password; }
    public function getUserName() { return $this->userName; }
    public function getDateCreated() { return $this->dataDateCreated; }
    public function getLastUpdate() { return $this->dataLastUpdate; }
    public function getViews() { return $this->dataClickCount; }
    public function getFeatured() { return $this->dataFeatured; }
    public function getSlug() { return $this->userSlug; }
    public function getPhone() { return $this->phone; }

    // Sets
    private function setUserID($userID) { $this->userID = $userID; }
    public function setUserFName($EXTuserFName) { $this->userFName = $EXTuserFName; }
    public function setUserMName($EXTuserMName) { $this->userMName = $EXTuserMName; }
    public function setUserLName($EXTuserLName) { $this->userLName = $EXTuserLName; }
    public function setUserMaN($EXTMaN) { $this->MaN = $EXTMaN; } // middleASnick
    public function setUserEmail($EXTuserEmail) { $this->userEmail = $EXTuserEmail; }
    public function setUserPassword($EXTpassword) { $this->password = $EXTpassword;}
    private function setUserName($userName) { $this->userName = $userName; }
    public function setDateCreated($EXTdateCreated) { $this->dataDateCreated = $EXTdateCreated; }
    public function setLastUpdate($EXTlastUpdate) { $this->dataLastUpdate = $EXTlastUpdate; }
    public function setViews($EXTclickCount) { $this->dataClickCount = $EXTclickCount; }
    public function setFeatured($EXTfeatured) { $this->dataFeatured = $EXTfeatured; }
    private function setSlug($EXTslug) { $this->userSlug = $EXTslug; }
    public function setphone($EXTphone) { $this->phone = $EXTphone; }

    /**
     * Depending on $case, will display the User's name in different formats,
     * such as Full Long Name, No Middle Name, LinkWorthy (no spaces).
     *
     * @param string $case
     */
    public function userFullName($case) {
	    switch ($case){
		    case 'long':
		    if ($this->getUserMName()) {
			    if ($this->getUserMaN())
			    { echo $this->getUserFName() . ' "'  . $this->getUserMName() . '" ' . $this->getUserLName(); }
			    else
			    { echo $this->getUserFName() . " " . $this->getUserMName() . " " . $this->getUserLName(); }
		    }
		    elseif (!$this->getUserMaN())
		    { echo $this->getUserFName() . ' ' . $this->getUserLName(); }
		    break;
		    case 'short':
			    echo $this->getUserFName() . ' ' . $this->getUserLName();
			    break;
		    case 'link':
			    echo $this->getUserFName() . $this->getUserLName();
			    break;
	    }
    }

    /**
     * Gets the data for the User class.
     *
     * @param string $dbname
     * @param object $dbcon
     */
    function populateUser($dbname,$dbcon) {
	    $sql = $dbcon->query("SELECT `userFName`, `userMName`, `userLName`, `middleASnick`, `phonenum`, `userEmail`, `password`, `slug`, DU.dateCreated, DU.lastUpdate, DU.clickCount, DU.featured FROM ".$dbname.".res_user U INNER JOIN ".$dbname.".res_data_user DU on U.userID=DU.userID WHERE U.userID='". $this->getUserID() ."' LIMIT 1");
	    while ($row = $sql->fetch_object()) {
		    $this->setUserFName($row->userFName);
		    $this->setUserMName($row->userMName);
		    $this->setUserLName($row->userLName);
		    $this->setUserMaN(ord($row->middleASnick));
		    $this->setUserEmail($row->userEmail);
		    $this->setUserPassword($row->password);
		    $this->setDateCreated($row->dateCreated);
		    $this->setLastUpdate($row->lastUpdate);
		    $this->setViews($row->clickCount);
		    $this->setFeatured(ord($row->featured));
		    $this->setSlug($row->userSlug);
		    $this->setPhone($row->phonenum);
	    }
    }

    /**
     * Reformats and displays the user's phone number.
     */
    public function phoneNumber() {
	    $exPhone = explode("-",$this->getPhone());
	    echo "(";
	    echo $exPhone[0];
	    echo ") ";
	    echo $exPhone[1];
	    echo "&ndash;";
	    echo $exPhone[2];
    }

    /**
     * Determines in which downloadable formats the user's resume is available.
     * @param int $which 
     */
    public function docFiller($which) {
	    if($which == 1) {
	    }
	    else {
		    echo "<a href=\"/doc/";
		    $this->userFullName('link');
		    echo ".pdf\"  class=\"noline\" title=\"PDF R&eacute;sum&eacute;\">PDF</a> &bull; <a href=\"/doc/";
		    $this->userFullName('link');
		    echo ".docx\" class=\"noline\" title=\"DOCX R&eacute;sum&eacute;\">DOCX</a> &bull; <a href=\"/doc/";
		    $this->userFullName('link');
		    echo ".doc\" class=\"noline\" title=\"DOC R&eacute;sum&eacute;\">DOC</a> &bull; <a href=\"/doc/";
		    $this->userFullName('link');
		    echo ".zip\" class=\"noline\" title=\"ZIP (PDF &amp; DOCX &amp; DOC R&eacute;sum&eacute;s\">ZIP</a> &bull; ";
	    }
    }

    /**
     * Shows link to user resume with and without a count of the views.
     *
     * @param string $uriPath
     * @param bool $view
     */
    public function userListItem($uriPath, $view) {
	    switch ($view) {
		    case '1':
			    echo "<li><a href='". $uriPath. "resume/". $this->getUserID() . "/' title='" . $this->getViews() . " views'>";
			    echo $this->userFullName('short');
			    echo "</a></li>";
			    break;
		    case '0':
			    echo "<li><a href='". $uriPath. "resume/". $this->getUserID() . "'>";
			    echo $this->userFullName('short');
			    echo "</a></li>";
			    break;
	    }
    }

    /**
     * Increments the user's pageviews.
     *
     * @param string $dbname
     * @param object $dbcon
     */
    private function anotherPageView($dbname, $dbcon) {
	    $sql = $dbcon->query("UPDATE ".$dbname.".res_data_user SET clickCount=". $this->getViews() ." WHERE userID='". $userID ."'");
	    mysql_connect('localhost', 'root', 'vivitron', 'resume_dev2');
	    $SETsql = mysql_query('UPDATE resume_dev2.res_data_user SET clickCount='. $this->setViews($clicks = $this->getViews() + 1) .' WHERE userID='. $userID .'');
	    mysql_db_query(resume_dev2, $SETsql);;
    }
}
?>
