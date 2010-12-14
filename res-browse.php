<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */

/**
 * Loads the settings, currently for db connections.
 */
include ('conf/settings.php');
/**
 * Auto-loads all of the necessary class files.
 * @param string $class Guesses the name of the class files.
 */
function __autoload($class) {
    include_once ($uriPath."lib/class/{$class}.php");
}
if (!isset($_GET['b'])) { $browse = "name"; }
else { $browse = $_GET['b']; }
?>
<!doctype html>
<html>
    <head>
	<title><?php echo ucfirst($browse); ?> &laquo; Browse | <?php echo sysName; ?></title>
	<!-- Using Blueprint-CSS /-->
	<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/print.css" type="text/css" media="print" />
	<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blocksANDspecs.css" type="text/css" media="screen, projection" />
	<!--[if IE]>
	    <link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/ie.css" type="text/css" media="screen, projection" />
	<![endif]-->
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	<meta name="description" content="Browse WVU MIS R&eacute;su&eacute; Book" />
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
	    <div id="content" class="span-24 browse">
		<article class="span-14 prepend-2 column">
		    <p>This is the browsey banana</p>
		    <nav>Browse by: <a href="<?php echo uriPath; ?>browse/name/">Name</a> &bull; <a href="<?php echo uriPath; ?>browse/year/">Graduation Year</a> &bull; <a href="<?php echo uriPath; ?>browse/major/">Major</a> &bull; <a href="<?php echo uriPath; ?>browse/minor/">Minor</a></nav>
		</article>
		<aside class="column prepend-2 last">
		    <form method="get" action="index.php" id="test" name="test">
			<input type="text" class="search quiet removed" name="s" value="Search Disabled" disabled="disabled" /><br />
			<a href="/ResumeBeta/search/" title="Advanced Search" class="noline small prepend-2">Advanced Search</a>
		    </form>
		</aside>
		<hr class="space" />
		<div id="browse">
		<?php $browsy = new Browse($dbcon, $browse); ?>
		</div>
		<hr class="space" />
	    </div>
	</div>
    </body>
</html>
