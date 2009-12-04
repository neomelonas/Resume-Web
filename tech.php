<?php
	if (!isset($_GET['user'])
	{ $userID = 1; }
	else
	{ $userID = $_GET['user']; }//Set userID to Neo for now, need to make a "splash" page.//
	include 'lib/php/db.php';
	include 'lib/php/functions.php';
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title><?php populateName($con, $userID); ?> | R&eacute;sum&eacute;</title>
		<link rel="stylesheet" type="text/css" href="lib/css/reset.css" />
		<link rel="stylesheet" type="text/css" href="lib/css/res.css" />
		<!--[if IE]>
			<link rel="stylesheet" type="text/css" href="lib/css/bad.css" />
		<![end if]/-->
		<noscript><link rel="stylesheet" type="text/css" href="lib/css/noscript.css" /></noscript>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	</head>
	<body>
		<div id="wrapper">
			<header>
				<?php populateHeader($userID); ?>
			</header>
			<nav id="nav">
				<h4>Click to Expand</h4>
				<hr />
				<ul>
					<li><a href="#" class="all">All</a></li>
					<li><a href="#" class="ed">Education</a></li>
					<li><a href="#" class="te">Technology Experience</a></li>
					<li><a href="#" class="rc">Relevant Curriculum</a></li>
					<li><a href="#" class="pe">Professional Experience</a></li>
					<li><a href="#" class="ia">Interests &amp; Activities</a></li>
					<li><a href="#" class="up noline">&uarr;</a></li>
				</ul>
				<hr />
			</nav>
			<div id="stuff">
				<h2><a href="#" class="ed noslip">Education</a></h2>
				<article id="education" class="slip">
					<?php populateEducation($userID); ?>
				</article>
				<h2><a href="#" class="te noslip">Technology Experience</a></h2>
				<article id="tech" class="slip">
					<?php populateTechDetails($userID,$teCount); ?>
				</article>
				<h2><a href="#" class="rc noslip">Relevant Curriculum</a></h2>
				<article id="curriculum" class="slip">
					<ul>
						<?php populateRC($userID); ?>
					</ul>
				</article>
				<h2><a href="#" class="pe noslip">Professional Experience</a></h2>
				<article id="experience" class="slip">
					<?php populateExp($userID); ?>
				</article>
				<h2><a href="#" class="ia noslip">Interests &amp; Activities</a></h2>
				<article id="intact" class="slip">
					<ul>
						<?php populateIntAct($userID); ?>
					</ul>
				</article>
			</div>
			<footer><div id="footer">
				<hr />
				<p>
					Download As:  <a href="<?php getShortName($userID); ?>.pdf" class="noline" title="PDF R&eacute;sum&eacute;">PDF</a> &#8226; <a href="<?php getShortName($userID); ?>.docx" class="noline" title="DOCX R&eacute;sum&eacute;">DOCX</a> &#8226; <a href="<?php getShortName($userID); ?>.doc" class="noline" title="DOC R&eacute;sum&eacute;">DOC</a> &#8226; <a href="<?php getShortName($userID); ?>.zip" class="noline" title="ZIP (PDF & DOCX & DOC R&eacute;sum&eacute;s)">ZIP</a>
				</p>
				<hr /></div>
			</footer>
		</div>
		<?php mysql_close($con); ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js/slide.min.js"></script>
	</body>
</html>
