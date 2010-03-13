<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
/**
 * Description of Browse
 *
 * @author Neo Melonas
 * @version 3.0.8
 * @since 3.0.8
 * @copyright 2010 Neo Melonas
 */
class Browse {
    public static function browseName($dbcon){
        $letter = "A";
	for ($counter = 1; $counter <= 26; $counter++){
	    echo "<h4><a id=". $letter .">". $letter ."</a></h4><ul id='browsename'>";
	    $sql = $dbcon->query("
		SELECT userID, userFName, userLName
		FROM res_user
		WHERE `userLName` LIKE '". $letter ."%'
		ORDER BY userLName ASC;
	    ");
	    while($row = $sql->fetch_object()){
		$userID = $row->userID;
		$ufname = $row->userFName;
		$ulname = $row->userLName;
		$username = $ufname . " " . $ulname;
		echo "<li><a href='/ResumeBeta/resume/". $userID . "/'>" . $username ."</a></li>";
	    }
	    $letter++;
	    echo "</ul>";
	}
    }
    public static function browseMajor($dbcon){
	$major = $dbcon->query("SELECT colID, colName FROM res_ed_col");
	while($junk = $major->fetch_object()){
	    echo "<h3>". $junk->colName ."</h3><ul>";
	    $sql = $dbcon->query("
		SELECT majorID, majorName 
		FROM res_ed_major
		WHERE colID=". $junk->colID ."
	    ");
	    while($row = $sql->fetch_object()) {
		echo "<li><h4>" . $row->majorName ."</h4><ul>";
		$moreSQL = $dbcon->query("
		    SELECT u.userID, `userFName`, `userLName`
		    FROM res_user u
		    INNER JOIN res_user_ed ue ON u.userID=ue.userID
		    INNER JOIN res_user_major um ON ue.ucID=um.ecdID
		    WHERE um.majorID=" . $row->majorID . "
		");
		while($lines = $moreSQL->fetch_object()) {
		    $userID = $lines->userID;
		    $ufname = $lines->userFName;
		    $ulname = $lines->userLName;
		    $username = $ufname . " " . $ulname;
		    echo "<li><a href=\"" . uriPath . "resume/" . $userID . "\"/>" . $username . "</a></li>";
		}
		echo "</ul>";
	    }
	    echo "</li><br/>";
	    echo "</ul>";
	}
    }
    public static function browseYear($dbcon){
	$finding = $dbcon->query("
	    SELECT DISTINCT `gradYear`
	    FROM res_user_ed
	    ORDER BY gradYear DESC
	");
	while($rows = $finding->fetch_object()) {
	    $year = $rows->gradYear;
	    echo "<h3>".$year."</h3><ul>";
	    $sql = $dbcon->query("
		SELECT U.userID, userFName, userLName
		FROM res_user U
		INNER JOIN res_user_ed UD on U.userID=UD.userID
		WHERE gradYear='". $rows->gradYear ."'
	    ");
	    while($row = $sql->fetch_object()) {
		$userID = $row->userID;
		$ufname = $row->userFName;
		$ulname = $row->userLName;
		$username = $ufname . " " . $ulname;
		echo "<li><a href=\"". uriPath ."resume/" . $userID . "\">" . $username . "</a></li>";
	    }
	    echo "</ul>";
	}
    }
}
?>
