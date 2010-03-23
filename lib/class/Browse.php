<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */
/**
 * Description of Browse
 * @package resume-web
 * @subpackage multiuser-resume
 * @author Neo Melonas
 * @version 3.0.8
 * @since 3.0.8
 * @copyright 2010 Neo Melonas
 */
class Browse {
    function __construct($dbcon, $type){
	if ($type == 'name'){
	    $this->browseName($dbcon);
	}
	else if ($type == 'major'){
	    $this->browseMajor($dbcon);
	}
	else if ($type == 'year'){
	    $this->browseYear($dbcon);
	}
	else if ($type == 'minor'){
	    $this->browseMinor($dbcon);
	}
    }

    private function browseName($dbcon){
        $letter = "A";
	echo "<nav><ul class='inline'>";
	$navLetter = "A";
	for ($counter = 1; $counter <= 26; $counter++) {
	    echo "<li><a href=#" . $navLetter . ">" . $navLetter . "</a></li>";
	    $navLetter++;
	}
	echo "</ul></nav>";;
	
	for ($counter = 1; $counter <= 26; $counter++){
	    $sql = $dbcon->query("
		SELECT slug, userFName, userLName
		FROM res_user
		WHERE `userLName` LIKE '". $letter ."%'
		ORDER BY userLName ASC;
	    ");
	    if ($sql->num_rows >= 1){
		echo "<h4><a id=". $letter .">". $letter ."</a></h4><ul id='browsename'>";
		while($row = $sql->fetch_object()){
		    $slug = $row->slug;
		    $ufname = $row->userFName;
		    $ulname = $row->userLName;
		    $username = $ufname . " " . $ulname;
		    echo "<li><a href='".uriPath."resume/". $slug . "/'>" . $username ."</a></li>";
		}
	    }
	    $letter++;
	    echo "</ul>";
	}
    }
    private function browseMajor($dbcon){
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
		    SELECT slug, `userFName`, `userLName`
		    FROM res_user u
		    INNER JOIN res_user_ed ue ON u.userID=ue.userID
		    INNER JOIN res_user_major um ON ue.ucID=um.ecdID
		    WHERE um.majorID=" . $row->majorID . "
		");
		while($lines = $moreSQL->fetch_object()) {
		    $slug = $lines->slug;
		    $ufname = $lines->userFName;
		    $ulname = $lines->userLName;
		    $username = $ufname . " " . $ulname;
		    echo "<li><a href=\"" . uriPath . "resume/" . $slug . "\"/>" . $username . "</a></li>";
		}
		echo "</ul>";
	    }
	    echo "</li><br/>";
	    echo "</ul>";
	}
    }
    private function browseYear($dbcon){
	$finding = $dbcon->query("
	    SELECT DISTINCT `gradYear`
	    FROM res_user_ed
	    ORDER BY gradYear DESC
	");
	while($rows = $finding->fetch_object()) {
	    $year = $rows->gradYear;
	    echo "<h3>".$year."</h3><ul>";
	    $sql = $dbcon->query("
		SELECT slug, userFName, userLName
		FROM res_user U
		INNER JOIN res_user_ed UD on U.userID=UD.userID
		WHERE gradYear='". $rows->gradYear ."'
	    ");
	    while($row = $sql->fetch_object()) {
		$slug = $row->slug;
		$ufname = $row->userFName;
		$ulname = $row->userLName;
		$username = $ufname . " " . $ulname;
		echo "<li><a href=\"". uriPath ."resume/" . $slug . "\">" . $username . "</a></li>";
	    }
	    echo "</ul>";
	}
    }
    private function browseMinor($dbcon){
	echo "<ul>";
	$sql = $dbcon->query("
	    SELECT minorID, minorName
	    FROM res_ed_minor
	");
	while($row = $sql->fetch_object()) {
	    echo "<li><h4>" . $row->minorName ."</h4><ul>";
	    $moreSQL = $dbcon->query("
		SELECT slug, `userFName`, `userLName`
		FROM res_user u
		INNER JOIN res_user_ed ue ON u.userID=ue.userID
		INNER JOIN res_user_minor um ON ue.ucID=um.ecdID
		WHERE um.minorID=" . $row->minorID . "
	    ");
	    while($lines = $moreSQL->fetch_object()) {
		$slug = $lines->slug;
		$ufname = $lines->userFName;
		$ulname = $lines->userLName;
		$username = $ufname . " " . $ulname;
		echo "<li><a href=\"" . uriPath . "resume/" . $slug . "\"/>" . $username . "</a></li>";
	    }
	    echo "</ul></li>";
	}
	echo "</ul>";
    }
}
