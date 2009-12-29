<?php  
include ('lib/conf/settings.inc');
include ('lib/php/functions.php');
db_connect($con);
//if (isset($_GET['s'])) { $sString = $_GET['s']; echo $sString; }  // ECHO IS A TEST WOO.
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
		<!--[if lt IE 8]>
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
						<ul>
							<?php featured($uriPath); ?>
						</ul>
					</section>
					<section id="recentlyadded" class="prepend-2 column list last">
						 <h3>Recently Added R&eacute;sum&eacute;s:</h3>
						<ul>
							<?php recentAddition($uriPath); ?>
						</ul>
					</section>
				</article>
				<hr class="space" />
				<article class="span-20 prepend-3" id="secondrow">
					<section id="recentlyupdated" class="column list span-5">
						<h3>Recently Updated:</h3>
						<ul><?php recentUpdate($uriPath); ?></ul>
					</section>

					<section id="mostsearched" class="prepend-2 column list span-5">
						<h3>Most Searched Terms:</h3>
						<ul>
							<?php //mostSearched($uriPath); ?>
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
				<article class="span-22 prepend-1 clear">Like, I go toward the bottom?  But not at the bottom? Yea.</article>

				<footer class="span-24"><?php include ('lib/includes/footer.inc'); ?></footer>
			</div>
		</div>
	</body>
</html>
