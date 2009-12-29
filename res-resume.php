<?php
if (isset($_GET['u']))
{ $userID = $_GET['u']; }
include ('lib/conf/settings.inc');
include ('lib/php/functions.php');
db_connect($con);
if (isset($userID)) {
	AnotherPageView($userID);
	$userInfo = array();
	$userInfo['ID'] = $userID;
	FillUserInfo($userInfo);
}
else //{$userID=1;}
{die ('SHIIIT'); }
?>
<!doctype html>
<html>
	<head>
		<title><?php GetUserName($userID); ?> | R&eacute;sum&eacute;</title>
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/print.css" type="text/css" media="print" />
		<!--[if lt IE 8]>
			<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/ie.css" type="text/css" media="screen, projection" />
		<![endif]-->
		
		
		<link rel="stylesheet" type="text/css" href="<?php echo $uriPath; ?>lib/css/<?php //echo $restype; ?>res.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta name="description" content="Resume" />
	</head>
	<body>
		<div class="container showgrid">
			<header class="span-24">
			<div id="header">
				<?php GetUserInfo($userInfo); ?>
			</div>
			</header>
			<div id="next">
				<?php GetUserEd($userInfo); ?>
			</div>
			<hr />
			<a href="<?php echo $uriPath; ?>resetcount.php?u=<?php echo $userInfo['ID']; ?>">REMOVE THIS 
LINK</a>
			<footer><div id="footer">
				<hr />
				<p>
					Download As:  <a href="<?php //getPath($userID); ?>.pdf" class="noline" title="PDF R&eacute;sum&eacute;">PDF</a> &#8226; <a href="<?php //getShortName($userID); ?>.docx" class="noline" title="DOCX R&eacute;sum&eacute;">DOCX</a> &#8226; <a href="<?php //getShortName($userID); ?>.doc" class="noline" title="DOC R&eacute;sum&eacute;">DOC</a> &#8226; <a href="<?php //getShortName($userID); ?>.zip" class="noline" title="ZIP (PDF &amp; DOCX &amp; DOC R&eacute;sum&eacute;s)">ZIP</a>
				</p>
				<hr /></div>
			</footer> 
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js/slide.min.js"></script>
	</body>
</html>

