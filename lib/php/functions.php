<?php
function resumeCount($dbcon){
    $toast = 0;
    $sql = $dbcon->query("
	SELECT COUNT(userID) AS resumeCount FROM res_user
    ");
    while($row = $sql->fetch_object()){
	$toast = $row->resumeCount;
    }
    return $toast;
}
