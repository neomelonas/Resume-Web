<?php
class resdb {
	private $ready = false;


	public $charset;
	public $collate;
	public $real_escape = false;
	private $dbuser;
	
	function resdb($dbuser, $dbpassword, $dbname, $dbhost) {
		return $this->__construct($dbuser, $dbpassword, $dbname, $dbhost);
	}

	function __construct($dbuser, $dbpassword, $dbname, $dbhost) {
		register_shutdown_function(array(&$this, "__destruct"));

		if ( WP_DEBUG )
			$this->show_errors();

		if ( defined('DB_CHARSET') )
			$this->charset = DB_CHARSET;

		if ( defined('DB_COLLATE') )
			$this->collate = DB_COLLATE;

		$this->dbuser = $dbuser;

		$this->dbco = mysql_connect($dbhost, $dbuser, $dbpassword, true);
		
		if (!$this->dbco) { die "SHIIIIT"; }
	}
}
?>
