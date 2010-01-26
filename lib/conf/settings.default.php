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
$absPath    = "D:/Server/xampp/htdocs/ResumeBeta/";

/**
 * The following variables are for a MySQL based Database connection.
 *
 * In future versions, they may be replaced for a more non-specifc
 * database connection setup.
 *
 * You will be notified if that happens, promise.
 */
$dbhost	    = 'localhost';
$dbuser	    = 'resuser';
$dbpassword = 'password';
$dbname	    = 'resume';


/*	    !!STOP EDITING NOW!!	     */


$dbcon	    = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
if (mysqli_connect_errno()) { echo ("OH NO!  Here's what happened: ".mysqli_connect_error()); exit(); }
?>
