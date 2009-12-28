<?php
if (isset($_GET['u']))
{ $userID = $_GET['u']; }
include ('lib/conf/settings.inc');
include ('lib/php/functions.php');
db_connect($con);
if (isset($userID))
{ AnotherPageView($userID); }
else //{$userID=1;}
{die ('SHIIIT'); }
?>
<!doctype html>
<html>
	<head>
		<title><?php GetUserName($userID); ?> | R&eacute;sum&eacute;</title>
		<link rel="stylesheet" type="text/css" href="/<?php echo $uriPath; ?>lib/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="/<?php echo $uriPath; ?>lib/css/<?php //echo $restype; ?>res.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="lib/css/ie/<?php echo $restype; ?>.css" />
		<![end if]/-->
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="description" content="Resume" />
	<head>
	<body>
		<div id="wrapper">
			<header>
			<div id="header">
				<h1><?php GetUserName($userID); ?></h1>
				<h4><?php UserLocation($userID); ?></h4>
			</div>
			</header>
			<hr />
			
			
			<?php /*
			<footer><div id="footer">
				<hr />
				<p>
					Download As:  <a href="<?php //getPath($userID); ?>.pdf" class="noline" title="PDF R&eacute;sum&eacute;">PDF</a> &#8226; <a href="<?php //getShortName($userID); ?>.docx" class="noline" title="DOCX R&eacute;sum&eacute;">DOCX</a> &#8226; <a href="<?php //getShortName($userID); ?>.doc" class="noline" title="DOC R&eacute;sum&eacute;">DOC</a> &#8226; <a href="<?php //getShortName($userID); ?>.zip" class="noline" title="ZIP (PDF &amp; DOCX &amp; DOC R&eacute;sum&eacute;s)">ZIP</a>
				</p>
				<hr /></div>
			</footer> */ ?>
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js/slide.min.js"></script>
	</body>
</html>
