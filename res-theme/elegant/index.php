<!doctype html>
<html>
    <head>
	<title><?php echo $resuser->userFullName('long') . " | " . sysName;?></title>
	<link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/screen.css" type="text/css" media="screen, projection" />
	<!--[if IE]>
	    <link rel="stylesheet" href="<?php echo $uriPath; ?>lib/css/blueprint/ie.css" type="text/css" media="screen, projection" />
	<![endif]-->
	<link rel="stylesheet" type="text/css" href="<?php echo $uriPath; ?>res-theme/elegant/style.css" />
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="description" content="Resume" />
    </head>
	<body>
	    <a href="<?php echo $uriPath; ?>" class="floater">&larr;</a>
	    <a href="<?php echo $uriPath; ?>resetcount.php?u=<?php echo $resuser->getUserInfo('ID'); ?>">Pull this Link</a>
	    <div class="container">
		<header class="span-24">
		<div id="header">
		    <h1><?php echo $resuser->userFullName('long'); ?></h1>
		    <h4><?php $home->display(); ?></h4>
		    <?php if (!is_null($local->getLocID())) { echo "<h4>"; $local->display(); echo "</h4>"; }; ?>
		    <h4><?php echo $resuser->phoneNumber(); ?> &bull; <?php echo $resuser->getEmail(); ?></h4>
		</div>
		</header>
		<div id="next">
		    <?php
			if (!is_null($resuser->getUserInfo('statement'))){
			?><div id="personalStatement"><?php
			    if ($resuser->getUserInfo('objective')){
			    ?>
			    <section class="title noslip"><h2><a href="#" class="ps noslip">Objective</a></h2></section>
			    <?php }
			    else {
			    ?>
			    <section class="title noslip"><h2><a href="#" class="ps noslip">Personal Statement</a></h2></section>
			    <?php } ?>
			    <div id="statement"><p><?php echo $resuser->getUserInfo('statement'); ?></p></div>
		    </div>
		    <?php
			}
		    ?>
		    <div id="edBlock">
			<section class="title noslip">
			    <h2><a href="#" class="ed noslip">Education</a></h2>
			</section>
			<section id="education">
			    <?php $education->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of Ed /-->
		    <?php if ($resuser->getUserInfo('techType') == 1){?>
		    <div id="teBlock">
			<section class="title noslip">
			    <h2><a href="#" class="te noslip">Professional Skills</a></h2>
			</section>
			<section id="techGroups">
			    <?php $tech->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of Tech Skills /-->
		    <?php }?>
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
			    <?php $experience->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of ProExp /-->
		    <div id="iaBlock">
			<section class="title noslip">
			    <h2><a href="#" class="ia noslip">Interests &amp; Activities</a></h2>
			</section>
			<section id="intact">
			    <?php $intact->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of IntAct /-->
		    <?php if ($resuser->getUserInfo('techType') == 0){?>
		    <div id="teBlock">
			<section class="title noslip">
			    <h2><a href="#" class="te noslip">Professional Skills</a></h2>
			</section>
			<section id="techGroups">
			    <?php $tech->display(); ?>
			</section>
		    </div>
		    <div class="clear"></div><!-- End of Tech Skills /-->
		    <?php }?>
		</div>
		<hr class="space" />
		<footer><div id="footer">
		    <hr />
		    <p>Download As:  <?php echo $resuser->docLinks($resuser->getUserInfo('links')); ?></p>
		    <hr />
		    <p>Page views: <?php echo $resuser->getUserInfo('views'); ?></p>
		</div></footer>
	</div>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo "http://".$_SERVER['HTTP_HOST'].$uriPath; ?>lib/js/slide.js"></script>
    </body>
</html>
