<?php 
// settings.php
$uriPath	= "/ResumeBeta/";		// TRAILING SLASH...
$absPath	= "D:/Server/xampp/htdocs/ResumeBeta/";

$dbhost		= 'localhost';
$dbuser		= 'root';
$dbpassword	= 'vivitron';
$dbname		= 'resume_dev2';
$dbcon = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if (mysqli_connect_errno()) { echo ("OH SHIT!  Here's what happened: ".mysqli_connect_error()); exit(); }
?>
