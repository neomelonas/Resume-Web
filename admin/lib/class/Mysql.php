<?php

require_once 'lib/includes/constants.php';

class Mysql {
    private $conn;

    function __construct() {
	$this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or
			die('There was a problem connecting to the database.');
    }

    function verify_Username_and_Pass($un, $pwd) {
	$query = "
	    SELECT userID, userFName
	    FROM res_user
	    WHERE username = ? AND password = ?
	    LIMIT 1
	";
	if($stmt = $this->conn->prepare($query)) {
	    $stmt->bind_param('ss', $un, $pwd);
	    $stmt->execute();
	    
	    if($stmt->fetch()) {
		$stmt->close();
		return true;
	    }
	}
    }
    function updateFailure($un){
	$query = "
	    UPDATE res_user
	    SET loginFail=loginFail + 1;
	    WHERE username=".$un."
	";
	if($stmt = $this->conn->prepare($query)) {
	    $stmt->bind_param('sy', $un, $pwd);
	    $stmt->execute();
	     if($stmt->fetch()) {
		$stmt->close();
		return true;
	    }
	}
    }
}