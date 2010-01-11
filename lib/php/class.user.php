<?php
/*
 *	Project:	Resume-Web
 *	Branch:		multiuser
 *	Version:	v3.0.1
 *
 *	class.user.php
 */
class User {
	
	private userID;
	public userFName;
	public userMName;
	public userLName;
	//public userName
	private MaN;
	private userEmail;
	private password;
	
	function __construct($userID) { $this->userID = $userID; $userInfo = array(); $userInfo[ID] = $this->userID; }
	
	public function getUserID() { return $this->userID; }
	public function getUserFName() { return $this->userFName; }
	public function getUserMName() { return $this->userMName; }
	public function getUserLName() { return $this->userLName; }
	public function getUserMaN() { return $this->MaN; } // middleASnick
	public function getUserEmail() { return $this->userEmail; }
	public function getUserPassword() { return $this->password; }
	
	public function setUserID($userID) { $this->userID = $userID; }
	public function setUserFName($userFName) { $this->userFName = $userFName; }
	public function setUserMName($userMName) { $this->userMName = $userMName; }
	public function setUserLName($userLName) { $this->userLName = $userLName; }
	public function setUserMaN($MaN) { $this->MaN = $MaN; } // middleASnick
	public function setUserEmail($userEmail) { $this->userEmail = $userEmail; }
	
	public function userFullName() {
		if (isset($this->userMName)) {
			if (ord($this->MaN) == 1) 
			{ $userName = $this->userFName . ' "' . $this->userMName . '" ' . $this->userLName; }
			else
			{ $userName = $this->userFName . ' ' . $this->userMName . ' ' . $this->userLName; }
		}
		else 
		{ $userName = $this->userFName . ' ' . $this->userLName; }
	}
}
?>