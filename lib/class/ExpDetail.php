<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
 /**
 * ExpDetail extends Experience
 * It allows users to list different attributes of their
 * professional experience.
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.1.0
 * @since v3.0.3
 * @copyright 2009-2010 Neo Melonas
 */
class ExpDetail extends Experience {

    /**
     * This is the Class Constructor.
     *
     * It constructs the class.
     *
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    function __construct($dbcon,$userID) {
	parent::__construct($dbcon, $userID);
	$this->fillExpDetail($dbcon,$userID);
    }

    public function getInfo($offset, $thing){
	parent::getExpInfo($offset, $expThing);
    }

    /**
     *
     * @param int $offset The identifier for the object.
     * @param string $EXTdetail The input string for experience details
     */
    private function setExpDetail($offset,$EXTdetail) {
	$this->exp->offsetGet($offset)->offsetGet('details')->append($EXTdetail);
    }

    /**
     * This method fills the Detail subclass with tasty data.
     * 
     * @param object $dbcon The database connection object.
     * @param int $userID The user whose resume is being displayed.
     */
    private function fillExpDetail($dbcon,$userID){
	$iter = $this->exp->getIterator();
	while($iter->valid()){
	    $sql = $dbcon->query("
		SELECT `expPosID`, `detailDesc`
		FROM res_exp_detail D
		INNER JOIN res_user_exp UE on D.posID=UE.expPosID
		WHERE userID='" . $userID . "' AND UE.expID='". $this->exp->offsetGet($iter->key())->offsetGet('ID') ."'
	    ");
	    while($row = $sql->fetch_object()){
		$this->setExpDetail($iter->key(), $row->detailDesc);
	    }
	    $iter->next();
	}
    }

    public function display() {
	if ($this->howManyRows != 0) {
	    for ($counter = 1;$counter <= $this->howManyRows;$counter++) {
		echo "<article id=\"exp-" . $this->getExpInfo($counter,'ID') . ".\">";
		echo "<section class=\"span-10 column\">";
		echo "<span class=\"workname\">" . $this->getExpInfo($counter, 'name') . "</span><br />";
		echo "<span class=\"position\">" . $this->getExpInfo($counter, 'position') . "</span>";
		echo "</section>";
		echo "<section class=\"span-6 column\">";
		echo "<span class=\"citystate\">" . $this->expLocation($counter) . "</span>";
		echo "</section>";
		echo "<section class=\"span-6 column last\">";
		echo "<span class=\"citystate\">" . $this->showExpDate($counter) . "</span>";
		echo "</section><div class=\"clear\"></div>";
		echo "<section>";
		echo "<ul>";
		$iter = $this->getExpInfo($counter,'details')->getIterator();
		while($iter->valid()) {
		    echo "<li class=\"detail-" . $this->getExpInfo($counter, 'ID') ."\">{$iter->current()}</li>";
		    $iter->next();
		}
		echo "</ul>";
		echo "</section>";
		echo "</article>";
	    }
	}
    }

}
?>
