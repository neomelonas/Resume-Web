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
 * @version v3.0.5
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */

/**  Loads the settings, currently for db connections. */
include ('conf/settings.php');

/**
 * Auto-loads all of the class files.
 * @param string $loadable guesses the name of the class files.
 */
function __autoload($loadable) {
    include_once ($uriPath."lib/class/class.{$loadable}.php");
}
include_once ("lib/interface/interface.info.php");
include_once ("lib/interface/interface.display.php");
include ('conf/usersettings.php');

if (isset($_GET['u']))
{ $userID = $_GET['u']; }//AnotherPageView code here.}
/**
 * The following &lt;pre&gt; blocks will be pulled when Unit Tests are working.
 * @todo Make unit tests.
 */
if (isset($userID)) {
    $resuser = new User($userID,$dbname,$dbcon);
    $home = new Location($dbname,1,$resuser->getUserID(),$dbcon);
    $loc = new Location($dbname,0,$resuser->getUserID(),$dbcon);
    $te = new Technology($dbcon,$resuser->getUserID(),$restype);
    $ia = new IntAct($dbcon,$resuser->getUserID());
    $ed = new Education($dbcon,$resuser->getUserID());
    $exp = new ExpDetail($dbcon,$resuser->getUserID());
    $course = new Course($dbcon, $resuser->getUserID());
}
else {die ('User ID not specified.'); }

if ($resuser->getUserInfo('theme') != 0){
    include ($uriPath . "lib/theme/" . $resuser->getUserInfo('theme') . ".php");
}
else
{
?>
<!doctype html>
<html>
    <head>
	<title><?php echo $resuser->userFullName('long'); ?> | R&eacute;sum&eacute;</title>
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
	    <a href="<?php echo $uriPath; ?>resetcount.php?u=<?php echo $resuser->getUserInfo('ID'); ?>">Pull this Link</a>
	    <div class="container">
		<header class="span-24">
		<div id="header">
		    <h1><?php echo $resuser->userFullName('long'); ?></h1>
		    <h4><?php $home->display(); ?></h4>
		    <?php if (!is_null($loc->getLocID())) { echo "<h4>"; $loc->display(); echo "</h4>"; }; ?>
		    <h4><?php echo $resuser->phoneNumber(); ?> &bull; <?php echo "<a href=\"mailto:{$resuser->getUserInfo('email')}\">{$resuser->getUserInfo('email')}</a>"; ?></h4>
		</div>
		</header>
		<div id="next">
		    <div id="edBlock">
			<section class="title noslip">
			    <h2><a href="#" class="ed noslip">Education</a></h2>
			</section>
			<section id="education">
			    <?php $ed->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of Ed /-->
		    <div id="teBlock">
			<section class="title noslip">
			    <h2><a href="#" class="te noslip">Technology Skills</a></h2>
			</section>
			<section id="techGroups">
			    <?php $te->quickDisplay($restype); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of Tech Skills /-->
		     <div id="rcBlock">
			<section class="title noslip">
			    <h2><a href="#" class="rc noslip">Coursework</a></h2>
			</section>
			<section id="courses">
			    <?php $course->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of Courses /-->
		    <div id="expBlock">
			<section class="title noslip">
			    <h2><a href="#" class="pe noslip">Professional Experience</a></h2>
			</section>
			<section id="proexp">
			    <?php $exp->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of ProExp /-->
		    <div id="iaBlock">
			<section class="title noslip">
			    <h2><a href="#" class="ia noslip">Interests &amp; Activities</a></h2>
			</section>
			<section id="intact">
			    <?php $ia->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of IntAct /-->
		</div>
		<hr class="space" />
		<footer><div id="footer">
		    <hr />
		    <p>Download As:  <?php echo $resuser->docLinks($links); ?></p>
		    <hr />
		</div></footer>
	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'].$uriPath; ?>lib/js/slide.js"></script>
    </body>
</html>
<?php } ?>
