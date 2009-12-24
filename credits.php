<?php  
include ('lib/php/db.php');
include ('lib/conf/settings.inc');
include ('lib/php/functions.php');
db_connect($con);
if (isset($_GET['s'])) { $sString = $_GET['s']; echo $sString; }  // ECHO IS A TEST WOO.

?>
<!doctype html>
<html>
	<head>
		<title>WVU MIS R&eacute;sum&eacute; Splash Page</title>
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
					<p>This is the credits banana</p>
					<p>I strongly recommend using the "Advanced Search" Option.</p>
					<p class="alt">Seeing as the regular search doesn't work...</p>
				</article>
				<aside class="column prepend-2 last">
					<form method="get" action="results.php" id="simplesearch" name="simplesearch">
						<input type="text" class="search quiet removed" name="s" value="Search Disabled" disabled="disabled" /><br />
						<a href="search.php" title="Advanced Search" class="noline small prepend-2">Advanced Search</a>
					 </form>
				</aside>
				<hr class="space" />
				<article class="span-16 prepend-6">
					<section id="CSS">Built with the <a href="http://www.blueprintcss.org/">Blueprint CSS Framework</a></section>
					<section id="Site Design">Site design by <a href="http://neomelonas.com">Neo Melonas</a></section>
					<section id="Thanks">
						With thanks to:
						<ul class="nodots">
							<li>A. Graham Peace</li>
							<li>Virginia F. Kleist</li>
							<li>Nanda Surendra</li>
							<li>Neo Melonas</li>
							<li>Lauren Nicholson</li>
							<li>Kevin Beckett</li>
						</ul>
						</section>
					
				</article>
				<footer class="span-24"><?php include ('lib/includes/footer.inc'); ?></footer>
			</div>
		</div>
	</body>
</html>