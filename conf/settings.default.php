<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */

/**
 * This is the default settings file.
 * 
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */

/**
 * $uriPath MUST have both beginning and trailing slashes.
 *
 * An example:
 * <code>
 * $uriPath = /path/in/url/
 * </code>
 */
$uriPath    = "/path/to/resume/";

/**
 * $absPath MUST be set.
 *
 * Examples include:
 * <code>
 * $absPath = /var/www/public_html/resume/
 * </code>
 * AND (for Windows environments)
 * <code>
 * $absPath = C:/Resume/
 * </code>
 */
$absPath    = "C:/xampp/htdocs/resume/";

/**
 * The following variables are for an abstracted Database connection.
 *
 * Just tell it what
 *
 * You will be notified if that happens, promise.
 */

/** @var the Database Type */
$dbtype		= 'mysqli';
/** @var the Database Host */
$dbhost		= 'localhost';
/** @var the Database User */
$dbuser		= 'resuser';
/** @var the Database User's Password */
$dbpass		= 'password';
/** @var the Database to be used */
$dbname		= 'resumeDB';


/*	    !!STOP EDITING NOW!!	     */
$dbcon	    = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if (mysqli_connect_errno()) { echo ("OH NO!  Here's what happened: ".mysqli_connect_error()); exit(); }
?>
