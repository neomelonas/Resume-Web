<?php 
/**
 * @package multiuser-resume
 */
/**
 * The IntAct class creates a list of users' interests and activites.
 *
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 *
 * @example ../settings.default.php Example Settings
 */


$uriPath	= "/ResumeBeta/";		// TRAILING SLASH...
$absPath	= "D:/Server/xampp/htdocs/ResumeBeta/";

$dbhost		= 'localhost';
$dbuser		= 'root';
$dbpassword	= 'vivitron';
$dbname		= 'resume_dev2';
$dbcon = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if (mysqli_connect_errno()) { echo ("OH SHIT!  Here's what happened: ".mysqli_connect_error()); exit(); }
?>
