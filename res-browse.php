<?php  
include ('lib/conf/settings.inc');
include ('lib/php/functions.php');
db_connect($con);
if (!isset($_GET['b'])) { $browse = "name"; }
else { $browse = $_GET['b']; }
?>
<!doctype html>
<html>
	<head>
		<title>WVU MIS R&eacute;sum&eacute; Splash Page</title>
		<!-- Using Blueprint-CSS /-->
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/link-icons/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/plugins/buttons/screen.css" type="text/css" media="screen, projection" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/print.css" type="text/css" media="print" />
		<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blocksANDspecs.css" type="text/css" media="screen, projection" />
		<!--[if lt IE 8]>
			<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/ie.css" type="text/css" media="screen, projection" />
		<![endif]-->
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Browse WVU MIS R&eacute;su&eacute; Book" />
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
					<p>This is the browsey banana</p>
					<nav>Browse by: <a href="/ResumeBeta/browse/name/">Name</a> &bull; <a href="/ResumeBeta/browse/year/">Graduation Year</a> &bull; <a href="/ResumeBeta/browse/major/">Major</a></nav>
				</article>
				<aside class="column prepend-2 last">
					<form method="get" action="index.php" id="test" name="test">
						<input type="text" class="search quiet removed" name="s" value="Search Disabled" disabled="disabled" /><br />
						<a href="/ResumeBeta/search/" title="Advanced Search" class="noline small prepend-2">Advanced Search</a>
					 </form>
				</aside>
				<hr class="space" />
				
				<?php 
				if ($browse == 'name') {
					echo "<nav><ul class='inline'>";
					$letter = "A";
					for ($counter = 1; $counter <= 26; $counter++) {
						echo "<li><a href=#" . $letter . ">" . $letter . "</a></li>";
						$letter++;
					}					
					echo "</ul></nav>";
				}
					browsing($browse);
				?>
				<hr class="space" />
				<article class="span-22 prepend-1 clear">Like, I go toward the bottom?  But not at the bottom? Yea.</article>
				<footer class="span-24"><?php include ('lib/includes/footer.inc'); ?></footer>
			</div>
		</div>
	</body>
</html>
