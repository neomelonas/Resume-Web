<?php
		include 'lib/php/db.php';
		include 'lib/php/functions.php';
		$userID = $_GET['user'];
		if (!isset($userID))
		{ $userID = 1; }
		else
		{ $userID = getUserTag($userID); }//Set userID to Neo for now, need to make $
?>
<!doctype html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="lib/css/reset.css" />
		<title><? populateName($con, $userID); ?> | R&eacute;sum&eacute;</title>
		<link rel="stylesheet" type="text/css" href="lib/css/res.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="lib/css/bad.css" />
		<![end if]/-->
		<noscript><link rel="stylesheet" type="text/css" href="lib/css/noscript.css" /></noscript>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
		<meta charset="UTF-8">
		<!-- Eventually do other "meta" stuff /-->
	</head>
	<body>
		<div id="wrapper">
			<header>
				<? populateHeader($userID); ?>
			</header>
			<nav id="nav">
				<h4>Click to Expand</h4>
				<hr />
				<ul>
					<li><a href="#" class="all">All</a></li>
					<li><a href="#" class="ed">Education</a></li>
					<li><a href="#" class="rc">Relevant Curriculum</a></li>
					<li><a href="#" class="pe">Professional Experience</a></li>
					<li><a href="#" class="ia">Interests &amp; Activities</a></li>
					<li><a href="#" class="te">Technology Experience</a></li>
					<li><a href="#" class="up noline">&uarr;</a></li>
				</ul>
				<hr />
			</nav>
			<div id="stuff">
				<h2><a href="#" class="ed noslip">Education</a></h2>
				<div id="education" class="slip">
					<?php populateEducation($userID); ?>
				</div>
				<h2><a href="#" class="rc noslip">Relevant Curriculum</a></h2>
				<div id="curriculum" class="slip">
					<ul>
						<? populateRC($userID); ?>
					</ul>
				</div>
				<h2><a href="#" class="pe noslip">Professional Experience</a></h2>
				<div id="experience" class="slip">
					<? populateExp($userID); ?>
				</div>
				<h2><a href="#" class="ia noslip">Interests &amp; Activities</a></h2>
				<div id="intact" class="slip">
					<ul>
						<? populateIntAct($userID); ?>
					</ul>
				</div>
				<h2><a href="#" class="te noslip">Technology Experience</a></h2>
				<div id="tech" class="slip">
					<ul>
						<? populateTechExp($userID); ?>
					</ul>
				</div>
			</div>
			<footer><div id="footer">
				<hr />
				<p>
					Download As:  <a href="<? getPath($userID); ?>.pdf" class="noline" title="PDF R&eacute;sum&eacute;">PDF</a> &#8226; <a href="<? getShortName($userID); ?>.docx" class="noline" title="DOCX R&eacute;sum&eacute;">DOCX</a> &#8226; <a href="<? getShortName($userID); ?>.doc" class="noline" title="DOC R&eacute;sum&eacute;">DOC</a> &#8226; <a href="<? getShortName($userID); ?>.zip" class="noline" title="ZIP (PDF & DOCX & DOC R&eacute;sum&eacute;s)">ZIP</a>
				</p>
				<hr /></div>
			</footer>
		</div>
		<? mysql_close($con); ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js/slide.min.js"></script>
	</body>
</html>
