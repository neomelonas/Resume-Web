<?php
/**
 * This page displays resumes!  WHICH IS AWESOME, promise.
 *
 * @package resume-web
 * @subpackage multiuser-resume
 */
 /**
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.1.0
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */

/**  Loads the settings, currently for db connections. */
include ('conf/settings.php');

/**
 * Auto-loads all of the class files.
 * @param string $loadable guesses the name of the class files.
 */
function __autoload($class) {
    include_once ($uriPath."lib/class/{$class}.php");
}

if (isset($_GET['u']))
{ $userID = $_GET['u']; }
?>
<!doctype html>
<html>
	<head>
		<title>WVU MIS R&eacute;sum&eacute; BLANK Page</title>
		<!-- Using Blueprint-CSS /-->
		<link rel="stylesheet" href="lib/css/blueprint/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="lib/css/blueprint/plugins/link-icons/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="lib/css/blueprint/plugins/buttons/screen.css" type="text/css" media="screen, projection">
		<link rel="stylesheet" href="lib/css/blueprint/print.css" type="text/css" media="print">
		<link rel="stylesheet" href="lib/css/blocksANDspecs.css" type="text/css" media="screen, projection">
		<!--[if lt IE 8]>
			<link rel="stylesheet" href="lib/css/blueprint/ie.css" type="text/css" media="screen, projection">
		<![endif]-->
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="WVU MIS R&eacute;su&eacute; Book" />
	</head>
	<body>
		<div class="container">
			<div id="header">
			<header class="span-24 last prepend-top">
				<h1 class="bottom"><a href="/<?php echo $uriPath; ?>">WVU MIS R&eacute;sum&eacute; Book</a></h1>
				<h2 class="alt top">We Really are Quite Incredibly Awesome</h2>
			</header>
			</div>
			<hr />
			<div id="content" class="span-24 ">
				<article class="span-14 prepend-2 column">
					<p>This is the top banana</p>
					<p>I strongly recommend using the "Advanced Search" Option.</p>
					<p class="alt">Seeing as the regular search doesn't work...</p>
				</article>
				<aside class="column prepend-2 last">
					<form method="get" action="index.php" id="test" name="test">
						<input type="text" class="search quiet removed" name="s" value="Search Disabled" disabled="disabled" /><br />
						<a href="search.php" title="Advanced Search" class="noline small prepend-2 error">Advanced Search</a>
					 </form>
				</aside>
				<hr class="space" />
				<article class="span-22 prepend-1 clear">Like, I go toward the bottom?  But not at the bottom? Yea.</article>
				<footer class="span-24"><?php include ('lib/includes/footer.inc'); ?></footer>
			</div>
		</div>
	</body>
</html>