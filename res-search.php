<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */

/**  Loads the settings, currently for db connections. */
include ('lib/conf/settings.inc');

/**  Loads the procedural functions.  Like the search. */
include ('lib/php/functions.php');
db_connect($con);
if (isset($_GET['q'])) { $sString = $_GET['q']; echo $sString; }  // ECHO IS A TEST WOO.

?>
<!doctype html>
<html>
	<head>
		<title>WVU MIS R&eacute;sum&eacute; Splash Page</title>
		<!-- Using Blueprint-CSS /-->
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/link-icons/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/buttons/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/print.css" type="text/css" media="print">
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blocksANDspecs.css" type="text/css" media="screen, projection">
		<!--[if lt IE 8]>
			<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/ie.css" type="text/css" media="screen, projection">
		<![endif]-->
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Search WVU MIS R&eacute;su&eacute; Book" />
	</head>
	<body>
		<div class="container">
			<div id="header">
			<header class="span-24 last prepend-top">
				<h1 class="bottom"><a href="<?php echo $uriPath; ?>">WVU MIS R&eacute;sum&eacute; Book</a></h1>
				<h2 class="alt top">We Really are Quite Incredibly Awesome</h2>
			</header>
			</div>
			<hr />
			<div id="content" class="span-24 ">
				<article class="span-14 prepend-2 column">
					<p>This is the search banana</p>
					<p>I strongly recommend using the "Advanced Search" Option.</p>
					<p class="alt">Seeing as the regular search doesn't work...</p>
				</article>
				<aside class="column prepend-2 last">
					<form method="get" action="results.php" id="simplesearch" name="simplesearch">
						<input type="text" class="search quiet removed" name="q" value="Search Disabled" disabled="disabled" /><br />
						<a href="/ResumeBeta/search/" title="Advanced Search" class="noline small prepend-2">Advanced Search</a>
					 </form>
				</aside>
				<hr class="space" />
				<article class="span-20 prepend-2">
					<form method="get" action="" id="advancedsearch" name="advancedsearch">
						<label for="search">Search for:&nbsp;</label><input type="text" class="text" name="q" id="search"/>
						<input type="checkbox" name="ed" value="1" /><label for="ed">Education</label>
						<input type="checkbox" name="pe" value="1" /><label for="pe">Experience</label>
						<input type="checkbox" name="rc" value="1" /><label for="rc">Coursework</label>
						
					</form>
				</article>
				<hr class="space" />
				<article class="span-22 prepend-1 clear">Like, I go toward the bottom?  But not at the bottom? Yea.</article>

				<footer class="span-24"><?php include ('lib/includes/footer.inc'); ?></footer>
			</div>
		</div>
	</body>
</html>
