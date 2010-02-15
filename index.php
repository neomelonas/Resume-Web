<?php
<<<<<<< HEAD
/**
 * This is the splash page.
 *
 * @package resume-web
 * @subpackage multiuser-resume
 */
 
/**
 * @author Neo Melonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */

/** Loads the settings, currently for db connections. */
include ('conf/settings.php');

/** Stupid thing.  Needs to be killed.
 * @deprecated
 */
include ('conf/settings.inc');

/** Does some procedural stuff that really does not need done in OOP. */
include ('lib/php/functions.php');

/**
 * Database connection
 *
 * Uses mysql, not mysqli.
 *
 * @deprecated
 */
db_connect($con);
?>
<!doctype html>
<html>
    <head>
        <title>WVU MIS R&eacute;sum&eacute; Splash Page</title>
	<!-- Using Blueprint-CSS /-->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /><!-- Favicon /-->
        <link rel="stylesheet" href="lib/css/blueprint/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/plugins/link-icons/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/plugins/buttons/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="lib/css/blocksANDspecs.css" type="text/css" media="screen, projection" />
        <!--[if IE]>
            <link rel="stylesheet" href="lib/css/blueprint/ie.css" type="text/css" media="screen, projection" />
        <![endif]-->
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <meta name="description" content="WVU MIS R&eacute;su&eacute; Book" />
    </head>
    <body>
        <div class="container">
            <div id="header">
            <header class="span-24 last prepend-top">
                <h1 class="bottom"><a href="/<?php echo $uriPath; ?>">WVU MIS R&eacute;sum&eacute; Book</a></h1>
                <h2 class="alt top"><!--We Really are Quite Incredibly Awesome/-->THIS IS UNDER CONSTRUCTION</h2>
            </header>
            </div>
            <hr />
            <div id="content" class="span-24 ">
                <article class="span-14 prepend-2 column">
                    <p>This is the top banana.  Maybe news goes here?  That sounds nice.</p>
                    <p>I strongly recommend against either Search Option.</p>
                    <p class="alt">Seeing as neither one works.</p>
                </article>
                <aside class="column prepend-2 last">
                    <form method="get" action="index.php" id="test" name="test">
                        <input type="text" class="search quiet removed" name="s" value="Search Disabled" disabled="disabled" /><br />
                        <a href="/ResumeBeta/search/" title="Advanced Search" class="noline small prepend-2">Advanced Search</a>
                     </form>
                </aside>
                <hr class="space" />
                <article class="span-20 prepend-3" id="firstrow">
                    <section id="mostviewed" class="column list span-5">
                        <h3>Most Viewed R&eacute;sum&eacute;s:</h3>
                        <ul><?php mostViewed($uriPath); ?></ul>
                    </section>
                    <section id="featured" class="prepend-2 colborder column list span-5">
                        <h3>Featured R&eacute;sum&eacute;s:</h3>
                        <ul><?php featured($uriPath); ?></ul>
                    </section>
                    <section id="recentlyadded" class="prepend-2 column list last">
                        <h3>Recently Added R&eacute;sum&eacute;s:</h3>
                        <ul><?php recentAddition($uriPath); ?></ul>
                    </section>
                </article>
                <hr class="space" />
                <article class="span-20 prepend-3" id="secondrow">
                    <section id="recentlyupdated" class="column list span-5">
                        <h3>Recently Updated:</h3>
                        <ul><?php recentUpdate($uriPath); ?></ul>
                    </section>
                    <section id="mostsearched" class="prepend-2 column list span-5">
                        <h3 class='error'>Most Searched Terms:</h3>
                        <ul><?php //mostSearched($uriPath); ?>
                            <li>LIST ONE</li>
                            <li>LIST TWO</li>
                            <li>LIST THREE</li>
                            <li>LIST FOUR</li>
                            <li>LIST FIVE</li>
                        </ul>
                    </section>
                    <section id="browse" class="prepend-2 column list last">
                        <h3>Browse...</h3>
                        <ul>
                            <li><a href="./browse/name/">By Name</a></li>
                            <li><a href="./browse/year/">By Intended Graduation Year</a></li>
                            <li><a href="./browse/major/">By Major</a></li>
                        </ul>
                    </section>
                </article>
                <hr class="space" />
                <article class="span-22 prepend-1 clear">
                    <?php
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $hostaddress = gethostbyaddr($ip);
                    $browser = $_SERVER['HTTP_USER_AGENT'];
                    $referred = $_SERVER['HTTP_REFERER']; // a quirky spelling mistake that stuck in php

                    print "<strong>Display IP address:</strong><br />\n";
                    print "$ip<br /><br />\n";
                    print "<strong>More detailed host address:</strong><br />\n";
                    print "$hostaddress<br /><br />\n";
                    print "<strong>Display browser info</strong>:<br />\n";
                    print "$browser<br /><br />\n";
                    print "<strong>Where you came from (if you clicked on a link to get here</strong>:<br />\n";
                    if ($referred == "") {
                        print "Page was directly requested";
                    }
                    else {
                        print "$referred";
                    }
                    ?>

                </article>
                <footer class="span-24"><?php include ('lib/inc/footer.inc'); ?></footer>
            </div>
        </div>
    </body>
=======
		include 'lib/php/db.php';
		include 'lib/php/functions.php';
		if (isset($_GET['user']))
		{ $userID = $_GET['user']; }
		else
		{ $userID = 1; }
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
			<nav class="nav">
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
					Download As:  <a href="<? getPath($userID); ?>.pdf" class="noline" title="PDF R&eacute;sum&eacute;">PDF</a> &#8226; <a href="<? getShortName($userID); ?>.docx" class="noline" title="DOCX R&eacute;sum&eacute;">DOCX</a> &#8226; <a href="<? getShortName($userID); ?>.doc" class="noline" title="DOC R&eacute;sum&eacute;">DOC</a> &#8226; <a href="<? getShortName($userID); ?>.zip" class="noline" title="ZIP (PDF &amp; DOCX &amp; DOC R&eacute;sum&eacute;s)">ZIP</a>
				</p>
				<hr /></div>
			</footer>
		</div>
		<? mysql_close($con); ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js/slide.min.js"></script>
	</body>
>>>>>>> cce638a96bbdf0cfe02d97b6685f4200ab6004d6
</html>
