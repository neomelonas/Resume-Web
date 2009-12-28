<?php
// res_header.php
//
// Does Stuff!
// It's great.
//
include 'lib/php/db.php';
include 'lib/php/functions.php';
// Basic URL structure is:
// [Tentative][mod_rewrite]
// http://wvumisa.com/resume/UserName
// [Tentative][real]
// http://wvumisa.com/resume?u=UserName

$con = mysql_connect($host,$name,$pwd);
dbConnectGO($con);

if (isset($_GET['user']))
{ $userTag = $_GET['user']; }
else
{ $userTag = 'NeoMelonas'; }
if ((isset($userTag)) && !(isset($userID)))
{ $userID = getUserID($userTag); }
//
// 
//
?><!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="lib/css/reset.css" />
		<title><?php populateName($userID); ?> &lt; MIS  R&eacute;sum&eacute; Book | WVUMISA.com</title>
		<link rel="stylesheet" type="text/css" href="lib/css/res.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="lib/css/bad.css" />
		<![end if]/-->
		<noscript><link rel="stylesheet" type="text/css" href="lib/css/noscript.css" /></noscript>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<!-- Eventually do other "meta" stuff /-->
	</head>
	<body>
		<div id="wrapper">
			<header>
				<? populateHeader($userID); ?>
			</header>
			<?php navigation($userID); ?>
		</div>