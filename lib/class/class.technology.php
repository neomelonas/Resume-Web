<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * The Technology class provides users multiple styles
 * of lists of their technology backgrounds.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.3
 * @copyright 2009-2010 Neo Melonas
 */
class Technology {
    /**
     * Shows the count of how many tech items there are.  Somewhere.
     * @var int
     */
    private $teCount;
    /**
     * Holds all of the Programming Language tech items.
     * @var array
     */
    private $languages = array();
    /**
     * Holds all of the Operating System tech items.
     * @var array
     */
    private $systems = array();
    /**
     * Holds all of the Program tech items.
     * @var array
     */
    private $programs = array();
    /**
     * Holds all of the Other tech items.
     * @var array
     */
    private $other = array();
    /**
     * Holds all of the tech items when not in group form.
     * @var array
     */
    private $noGroup = array();

    /**
     * This is the Class Constructor.
     *
     * It constructs the class.
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     * @param bool $groups Switch for determining whether or not to show the Tech data in groups or in an OL.
     */
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

    /**
     * getTeCount
     *
     * Gets the teCount for the class Technology.
     *
     * @return <type> Returns the instance's teCount.
     */
    public function getTeCount() {
	return $this->teCount;
    }

    /**
     *
     * @return object Returns the instance's Programming Language Array
     */
    public function getLanguages() {
	return $this->languages;
    }
    public function getSystems() {
	return $this->systems;
    }
    public function getPrograms() {
	return $this->programs;
    }
    public function getOther() {
	return $this->other;
    }

    /**
     * setTeCount
     *
     * Method to set teCount.
     *
     * @param int $EXTteCount The input to set teCount.
     */
    public function setTeCount($EXTteCount) {
	$this->teCount = $EXTteCount;
    }

    /**
     * setLanguages
     *
     * Method to fill the Languages array.
     *
     * @param string $EXTlanguages Comes from the DB res_techexp.teDesc for languages.
     */
    public function setLanguages($EXTlanguages) {
	$this->languages->append($EXTlanguages);
    }

    /**
     * setSystmes
     *
     * Method to fill the Systems array.
     *
     * @param string $EXTsystems Comes from the DB res_techexp.teDesc for systems.
     */
    public function setSystems($EXTsystems) {
	$this->systems->append($EXTsystems);
    }

    /**
     * setPrograms
     *
     * Method to fill the Programs array.
     *
     * @param string $EXTprograms Comes from the DB res_techexp.teDesc for programs.
     */
    public function setPrograms($EXTprograms) {
	$this->programs->append($EXTprograms);
    }

    /**
     * setOther
     *
     * Method to fill the Other array.
     *
     * @param string $EXTother Comes from the DB res_techexp.teDesc for other.
     */
    public function setOther($EXTother) {
	$this->other->append($EXTother);
    }
    
    /**
     * setNoGroup
     * 
     * Method to fill the noGroup array.
     * 
     * @param string $EXTnoGroup Comes from the DB res_techexp.teDesc for no group.
     */
    public function setNoGroup($EXTnoGroup) {
	$this->noGroup->append($EXTnoGroup);
    }

    /**
     * This method fills the Programming Languages block with data.
     * It gets called when $groups is some kind of tech resume.
     *
     *
     * @param mysqli $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillTechLang($dbcon,$userID) {
	    $this->languages = new ArrayObject(array());
	    $sql = $dbcon->query("SELECT TE.teID, `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='language'");
	    while($row = $sql->fetch_object()) {
		    $this->languages->append($row->teDesc);
	    }
    }

    /**
     * This method fills the Operating Systems block with data.
     * It gets called when $groups is some kind of tech resume.
     *
     *
     * @param mysqli $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillTechSys($dbcon,$userID) {
	    $this->systems = new ArrayObject();
	    $sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='OS'");
	    while($row = $sql->fetch_object()) {
		    $this->systems->append($row->teDesc);
	    }
    }

    /**
     * This method fills the Programs block with data.
     * It gets called when $groups is some kind of tech resume.
     *
     *
     * @param mysqli $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillTechProg($dbcon,$userID) {
	    $this->programs = new ArrayObject();
	    $sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='program'");
	    while($row = $sql->fetch_object()) {
		    $this->programs->append($row->teDesc);
	    }
    }

    /**
     * This method fills the Other block with data.
     * It gets called when $groups is some kind of tech resume.
     *
     *
     * @param mysqli $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillTechOther($dbcon,$userID) {
	    $this->other = new ArrayObject();
	    $sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='other'");
	    while($row = $sql->fetch_object()) {
		    $this->other->append($row->teDesc);
	    }
    }

    /**
     * This method fills the tech block with data.
     * It gets called when $groups is *NOT* some kind of tech resume.
     *
     *
     * @param mysqli $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillTechNoGroup($dbcon,$userID) {
	    $this->noGroup = new ArrayObject();
	    $sql = $dbcon->query("SELECT `teDesc` FROM res_techexp TE INNER JOIN res_user_tech UT on TE.teID=UT.teID WHERE userID='" . $userID . "' AND teType='nogroup'");
	    while($row = $sql->fetch_object()) {
		    $this->noGroup->append($row->teDesc);
	    }
    }

    /**
     * This function quickly displays all of the tech items.
     *
     * @deprecated Since v3.0.3 was finished.
     * @param bool $groups
     */
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
    /**
     * This method formats and displays the Programming Language data.
     */
    public function displayLang() {
	    $iterator = $this->languages->getIterator();
	    echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Languages: </span></li>";
	    while($iterator->valid()) {
		    echo "<li>{$iterator->current()};  \n</li>";
		    $iterator->next();
	    }
	    echo "</ul>";
    }
    /**
     * This method formats and displays the Operating Systems data.
     */
    public function displaySys() {
	    $iterator = $this->systems->getIterator();
	    echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Operating Systems: </span></li>";
	    while($iterator->valid()) {
		    echo "<li>{$iterator->current()};  \n</li>";
		    $iterator->next();
	    }
	    echo "</ul>";
    }
    /**
     * This method formats and displays the Programs data.
     */
    public function displayProg() {
	    $iterator = $this->programs->getIterator();
	    echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Programs: </span></li>";
	    while($iterator->valid()) {
		    echo "<li>{$iterator->current()};  \n</li>";
		    $iterator->next();
	    }
	    echo "</ul>";
    }
    /**
     * This method formats and displays the Other data.
     */
    public function displayOther() {
	    $iterator = $this->other->getIterator();
	    echo "<ul class=\"techDetails\"><li><span class=\"teTitle\">Other: </span></li>";
	    while($iterator->valid()) {
		    echo "<li>{$iterator->current()}</li>";
		    $iterator->next();
	    }
	    echo "</ul>";
    }
    /**
     * This method formats and displays the tech data, not in group format.
     */
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
