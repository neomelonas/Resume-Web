<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * The IntAct class creates a list of users' interests and activites.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.2
 * @copyright 2009-2010 Neo Melonas
 */
class IntAct {

    /**
     * The ia object
     *
     * @var object This contains all of the stuff for the IntAct.
     */
    private $ia;

    /**
     * This is the Class Constructor.
     *
     * It constructs the class.
     *
     * @param object $dbcon
     * @param int $userID
     */
    function __construct($dbcon,$userID) {
	$this->ia = new ArrayObject();
	$this->fillIA($dbcon,$userID);
    }

    /**
     * This is the Class Destructor.
     *
     * It cleans up when the class is kaput.
     */
    function __destruct() {}

    /**
     * Not really sure what I was doing here.
     *
     * @param mixed $iter
     * @return int|string
     */
    public function getIa($iter) {
	if($this->ia-offsetExists($iter)) {
	    return $this->ia->offsetGet($iter);
	}
    }
    public function getIaInputID() {
	return $this->inputID;
    }

    public function setIa($offset,$EXTiaDesc) { $this->ia->offsetSet($offset,$EXTiaDesc); }
    public function setIaWeight($EXTiaWeight) { $this->iaWeight->append($EXTiaWeight); }
    private function setIaInputID($EXTiaInuputID) { $this->inputID = $EXTiaInputID; }

    /**
     * This method fills the Interest & Activities information.
     *
     * @param object $dbcon
     * @param int $userID
     */
    public function fillIA($dbcon,$userID) {
	$this->ia = new ArrayObject();
	$this->iaWeight = new ArrayObject();
	$sql = $dbcon->query("SELECT I.iaID, `iaDesc`, `inputingUserID` FROM res_intact I INNER JOIN res_user_ia UIA on I.iaID=UIA.iaID WHERE userID='". $userID ."' ORDER BY `iaWeight` DESC");
	if ($sql){
	while($row = $sql->fetch_object()) {
	    $this->setIa($row->iaID,$row->iaDesc);
	    $this->setIaInputID($row->inputingUserID);
	}
    }}

    /**
     * This method shows off the user's interests & activities.
     */
    public function display() {
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
