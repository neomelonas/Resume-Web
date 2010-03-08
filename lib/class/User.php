<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
/**
 * User is the class that allows users to exist.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.1.0
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
class User{
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
     * @deprecated Preferred method is <code>$thing->getInfo('ID');</code>
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
		`userEmail`, `slug`, DU.dateCreated, DU.lastUpdate,
		DU.clickCount, DU.featured, pstate, resTheme, techType, links
	    FROM ".$dbname.".res_user U
	    INNER JOIN ".$dbname.".res_data_user DU on U.userID=DU.userID
	    INNER JOIN res_user_options o ON U.userID=o.userID
	    WHERE U.userID='". $this->getUserID() ."' LIMIT 1
	");
	while ($row = $sql->fetch_object()) {
	    $links = array();
	    $views = $row->clickCount + 1;
	    $this->setUserInfo('fName', $row->userFName);
	    $this->setUserInfo('mName', $row->userMName);
	    $this->setUserInfo('lName', $row->userLName);
	    $this->setUserInfo('MaN',$row->middleASnick);
	    $this->setUserInfo('email', $row->userEmail);
	    $this->setUserInfo('dateCreated', $row->dateCreated);
	    $this->setUserInfo('lastUpdate', $row->lastUpdate);
	    $this->setUserInfo('views' , $views);
	    $this->setUserInfo('featured', ord($row->featured));
	    $this->setUserInfo('slug', $row->userSlug);
	    $this->setUserInfo('phone', $row->phonenum);
	    $this->setUserInfo('theme', $row->resTheme);
	    $this->setUserInfo('statement', $row->pstate);
	    $quicklink = explode(',',$row->links);
	    foreach($quicklink as $key){
		array_push($links,$key);
	    }
	    $this->setUserInfo('links', $links);
	    $this->setUserInfo('techType', $row->techType);
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
     *
     * @param array $list A list of what types of documents to return.  Allowed types are doc, docx, pdf, & zip.
     * @return string $pile This returns a list of the documents stored on the server that the user wants accessible.
     */
    public function docLinks($list) {
	$pile = "";
	$c = count($list);
	$counter = 0;
	foreach ($list as $case){
	    $counter ++;
	    switch ($case){
		case 'pdf':
		    $plop = "<a href=\"/doc/". $this->userFullName('link').
		    ".pdf\"  class=\"noline\" title=\"PDF R&eacute;sum&eacute;\">PDF</a>";
		    break;
		case 'doc':
		    $plop = "<a href=\"/doc/" . $this->userFullName('link') .
		    ".doc\" class=\"noline\" title=\"DOC R&eacute;sum&eacute;\">DOC</a>";
		    break;
		case 'docx':
		    $plop = "<a href=\"/doc/" . $this->userFullName('link') .
		    ".docx\" class=\"noline\" title=\"DOCX R&eacute;sum&eacute;\">DOCX</a>";
		    break;
		case 'zip':
		    $plop = "<a href=\"/doc/" . $this->userFullName('link') .
		    ".zip\" class=\"noline\" title=\"ZIP R&eacute;sum&eacute;\">ZIP</a>";
		    break;
		default:
		    $arr = array('pdf','doc','docx','zip');
		    $this->docFiller($arr);
		    break;
	    }
	    $pile = $pile . $plop;
	    if ($counter != $c){
		 $pile = $pile . " &bull; ";
	    }
	}
	return $pile;
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
     *
     * @return string $email Returns the user's email address, formatted as a link.
     */
    public function getEmail(){
	$email = "<a href=\"mailto:";
	$email = $email . $this->getUserInfo('email');
	$email = $email . "\">";
	$email = $email . $this->getUserInfo('email');
	$email = $email . ".</a>";
	return $email;
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
