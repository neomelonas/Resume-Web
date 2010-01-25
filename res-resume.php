<?php
include ('lib/conf/settings.php');
function __autoload($class) { include_once ($uriPath."lib/class/class.{$class}.php"); }
include ('lib/conf/usersettings.php');

if (isset($_GET['u']))
{ $userID = $_GET['u']; }//AnotherPageView code here.}
echo "<pre>";
if (isset($userID)) {
	$resuser = new user($userID,$dbname,$dbcon);
	$phone = new phone($dbcon,$userID,1);
	$home = new location($dbname,1,$resuser->getUserID(),$dbcon);
	$loc = new location($dbname,0,$resuser->getUserID(),$dbcon);
	$te = new technology($dbcon,$resuser->getUserID(),$restype);
	$ia = new intact($dbcon,$resuser->getUserID());
	$ed = new education($dbcon,$resuser->getUserID(),$row->ucID);
}
else {die ('SHIIIT'); }
echo "</pre>";
?>
<!doctype html>
<html>
	<head>
		<title><?php $resuser->userFullName('long'); ?> | R&eacute;sum&eacute;</title>
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
		<div class="container">
			<header class="span-24">
			<div id="header">
				<h1><?php $resuser->userFullName('long'); ?></h1>
				<h4><?php $home->locationDisplay(); ?></h4>
				<?php if (!is_null($loc->getLocID())) { echo "<h4>"; $loc->locationDisplay(); echo "</h4>"; }; ?>
				<h4><?php echo $resuser->phoneNumber(); ?> &bull; <?php echo "<a href=\"mailto:{$resuser->getUserEmail()}\">{$resuser->getUserEmail()}</a>"; ?></h4>
			</div>
			</header>
			<div id="next">
				<article id="edBlock">
					<section class="title noslip">
						<h2><a href="#" class="ed noslip">Education</a></h2>
					</section>
					<section id="education">
					<?php
						$ed->displayEd();
					?>
					</section>
				</article>
				<div class="clear"></div>
				<article id="teBlock">
					<section class="title noslip">
						<h2><a href="#" class="te noslip">Technology Skills</a></h2>
					</section>
					<section id="techGroups">
						<?php $te->quickDisplay($restype); ?>
					</section>
				</article>
				<div class="clear"></div>
				<article id="iaBlock">
					<section class="title noslip">
						<h2><a href="#" class="ia noslip">Interests &amp; Activities</a></h2>
					</section>
					<section id="intact">
						<?php $ia->displayIA(); ?>
					</section>
				</article>
			</div>
			<hr class="space" />
			<a href="<?php echo $uriPath; ?>resetcount.php?u=<?php echo $resuser->getUserID(); ?>">REMOVE THIS 
LINK</a>
			<footer><div id="footer">
				<hr />
				<p>
					Download As:  <?php $resuser->docFiller($links); ?>
				</p>
				<hr /></div>
			</footer> 
		</div>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'].$uriPath; ?>lib/js/slide.js"></script>
	</body>
</html>

