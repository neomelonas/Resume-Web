<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */

/**
 * User is the class that allows users to exist.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.5
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
class User {
    /**
     * The user.
     * @since v3.0.5
     * @var array This ArrayObject will hold all of the user's info.
     */
    private $theuser;

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
	    $this->theuser = new ArrayObject();
	    $this->setUserInfo('ID',$userID);
	    $this->fill($dbname, $dbcon);
	    $this->anotherPageView($dbcon);
    }
    /**
     * Class destructor, kills off the class when stuff is done.
     */
    function __destruct() {}

    /**
     * Get some user Info.
     *
     * @since v3.0.5
     * @param string $userThing A request for information, from the user object.
     * @return string|int Returns specified bit of user info.
     */
    public function getUserInfo($userThing) { 
	return $this->theuser->offsetGet($userThing);
    }

    /**
     * @since v3.0.0
     * @deprecated
     * @return int Returns the userID.
     */
    public function getUserID() { return $this->getUserInfo('ID'); }

    /**
     * Set some user info.
     * 
     * @param string $offset The name of what is being set.
     * @param string|int $thing The value of what is being set.
     */
    private function setUserInfo($offset, $thing) {
	$this->theuser->offsetSet($offset, $thing);
    }

    /**
     * Depending on $case, will display the User's name in different formats,
     * such as Full Long Name, No Middle Name, LinkWorthy (no spaces).
     * 
     * @param string $case
     */
    public function userFullName($case) {
	    switch ($case){
		    case 'long':
		    if ($this->getUserInfo('mName')) {
			    if ($this->getUserInfo('MaN')) {
				return $this->getUserInfo('fName') . ' "'  . $this->getUserInfo('mName') . '" ' . $this->getUserInfo('lName');
			    }
			    else {
				return $this->getUserInfo('fName') . " " . $this->getUserInfo('mName') . " " . $this->getUserInfo('lName');
			    }
		    }
		    elseif (!$this->getUserInfo('mName')) {
			return $this->getUserInfo('fName') . ' ' . $this->getUserInfo('lName');
		    }
		    break;
		    case 'short':
			    if (($this->getUserInfo('mName')) && !($this->getUserInfo('MaN'))) {
				$string = $this->getUserInfo('mName');
				return $this->getUserInfo('fName') . ' ' . $string[0] . '. ' . $this->getUserInfo('lName');
			    }
			    else {
				return $this->getUserInfo('fName') . ' ' . $this->getUserInfo('lName');
			    }
			    break;
		    case 'link':
			    return $this->getUserInfo('fName') . $this->getUserInfo('lName');
			    break;
		    default:
			return $this->getUserInfo('fName') . ' ' . $this->getUserInfo('lName');
			break;
	    }
    }

    /**
     * Gets the data for the User class.
     *
     * @param string $dbname
     * @param object $dbcon
     */
    private function fill($dbname,$dbcon) {
	$sql = $dbcon->query("
	    SELECT `userFName`, `userMName`, `userLName`, `middleASnick`, `phonenum`,
		`userEmail`, `password`, `slug`, DU.dateCreated, DU.lastUpdate,
		DU.clickCount, DU.featured
	    FROM ".$dbname.".res_user U
	    INNER JOIN ".$dbname.".res_data_user DU on U.userID=DU.userID
	    WHERE U.userID='". $this->getUserID() ."' LIMIT 1
	");
	while ($row = $sql->fetch_object()) {
	    $this->setUserInfo('fName', $row->userFName);
	    $this->setUserInfo('mName', $row->userMName);
	    $this->setUserInfo('lName', $row->userLName);
	    $this->setUserInfo('MaN',$row->middleASnick);
	    $this->setUserInfo('email', $row->userEmail);
	    $this->setUserInfo('password',$row->password);
	    $this->setUserInfo('dateCreated', $row->dateCreated);
	    $this->setUserInfo('lastUpdate', $row->lastUpdate);
	    $views = $row->clickCount + 1;
	    $this->setUserInfo('views' , $views);
	    $this->setUserInfo('featured', ord($row->featured));
	    $this->setUserInfo('slug', $row->userSlug);
	    $this->setUserInfo('phone', $row->phonenum);
	}
    }

    /**
     * Reformats and displays the user's phone number.
     * There are EXPLOSIONS.
     */
    public function phoneNumber() {
	    $exPhone = explode("-",$this->getUserInfo('phone'));
	    return "(" . $exPhone[0] . ") " . $exPhone[1] .  "&ndash;" . $exPhone[2];
    }

    /**
     * Determines in which downloadable formats the user's resume is available.
     * 
     * @param int $which In what way do you want the documentList.  A User Specified Value, eventually.
     */
    public function docFiller($case) {
	switch ($case){
	    case 'pdf':
		return "<a href=\"/doc/";
		$this->userFullName('link');
		return ".pdf\"  class=\"noline\" title=\"PDF R&eacute;sum&eacute;\">PDF</a>";
		break;
	}





//	"<a href=\"/doc/" .
//	$this->userFullName('link') .
//	".pdf\"  class=\"noline\" title=\"PDF R&eacute;sum&eacute;\">PDF</a> &bull; <a href=\"/doc/" .
//	$this->userFullName('link') .
//	".docx\" class=\"noline\" title=\"DOCX R&eacute;sum&eacute;\">DOCX</a> &bull; <a href=\"/doc/" .
//	$this->userFullName('link') .
//	".doc\" class=\"noline\" title=\"DOC R&eacute;sum&eacute;\">DOC</a> &bull; <a href=\"/doc/" .
//	$this->userFullName('link') .
//	".zip\" class=\"noline\" title=\"ZIP (PDF &amp; DOCX &amp; DOC R&eacute;sum&eacute;s\">ZIP</a> &bull; ";
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
		echo "<li><a href='". $uriPath. "resume/". $this->getUserInfo('ID') . "/' title='" . $this->getUserInfo('views') . " views'>";
		echo $this->userFullName('short');
		echo "</a></li>";
		break;
	    case '0':
		echo "<li><a href='". $uriPath. "resume/". $this->getUserInfo('ID') . "'>";
		echo $this->userFullName('short');
		echo "</a></li>";
		break;
	}
    }

    /**
     * Increments the user's pageviews.
     *
     * @param object $dbcon
     */
    private function anotherPageView($dbcon) {
	$sql = $dbcon->query("UPDATE res_data_user SET clickCount=". $this->getUserInfo('views') ." WHERE userID='". $this->getUserInfo('ID') ."'");
	$sql->execute;
    }
}
?>
