<a href="<?php echo $uriPath; ?>" class="floater">&larr;</a>
<div class="container">
    <header class="span-24">
    <div id="header">
	<h1><?php echo $resuser->userFullName('long'); ?></h1>
	<h4><?php $home->display(); ?></h4>
	<?php if (!is_null($local->getLocID())) { echo "<h4>"; $local->display(); echo "</h4>"; }; ?>
	<h4><?php echo $resuser->phoneNumber(); ?> &bull; <?php echo $resuser->getEmail(); ?></h4>
    </div>
    </header>
    <nav>
	<ul>
	    <li><a href="#" class="all">All</a></li>
	    <?php if ($resuser->getUserInfo('objective')){
		echo "<li></li>";
	    }?>
	    <li><a class="ed" href="#">Education</a></li>
	    <?php if ($resuser->getUserInfo('techType') == 1){?>
	    <li><a class="te" href="#">Professional Skills</a></li>
	    <?php } ?>
	    <li><a class="rc" href="#">Coursework</a></li>
	    <li><a class="pe" href="#">Professional Experience</a></li>
	    <li><a class="ia" href="#">Interests &amp; Activities</a></li>
	    <?php if ($resuser->getUserInfo('techType') == 0){?>
	    <li><a class="te" href="#">Professional Skills</a></li>
	    <?php } ?>
	    <li><a href="#" class="up">&uarr;</a></li>
	</ul>
    </nav>
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
		<div id="statement" class="slip"><p><?php echo $resuser->getUserInfo('statement'); ?></p></div>
	</div>
	<?php
	    }
	?>
	<div id="edBlock">
	    <section class="title noslip">
		<h2><a href="#" class="ed noslip">Education</a></h2>
	    </section>
	    <section id="education" class="slip">
		<?php $education->display(); ?>
	    </section>
	</div>
	<div class="clear"></div><!-- End of Ed /-->
	<?php if ($resuser->getUserInfo('techType') == 1){?>
	<div id="teBlock">
	    <section class="title noslip">
		<h2><a href="#" class="te noslip">Professional Skills</a></h2>
	    </section>
	    <section id="techGroups" class="slip">
		<?php $tech->display(); ?>
	    </section>
	</div>
	<div class="clear"></div><!-- End of Tech Skills /-->
	<?php }?>
	 <div id="rcBlock">
	    <section class="title noslip">
		<h2><a href="#" class="rc noslip">Coursework</a></h2>
	    </section>
	    <section id="courses" class="slip">
		<?php $course->display(); ?>
	    </section>
	</div>
	<div class="clear"></div><!-- End of Courses /-->
	<div id="expBlock">
	    <section class="title noslip">
		<h2><a href="#" class="pe noslip">Professional Experience</a></h2>
	    </section>
	    <section id="proexp" class="slip">
		<?php $experience->display(); ?>
	    </section>
	</div>
	<div class="clear"></div><!-- End of ProExp /-->
	<div id="iaBlock">
	    <section class="title noslip">
		<h2><a href="#" class="ia noslip">Interests &amp; Activities</a></h2>
	    </section>
	    <section id="intact" class="slip">
		<?php $intact->display(); ?>
	    </section>
	</div>
	<div class="clear"></div><!-- End of IntAct /-->
	<?php if ($resuser->getUserInfo('techType') == 0){?>
	<div id="teBlock">
	    <section class="title noslip">
		<h2><a href="#" class="te noslip">Professional Skills</a></h2>
	    </section>
	    <section id="techGroups" class="slip">
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