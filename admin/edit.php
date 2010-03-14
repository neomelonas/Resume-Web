<?php
require_once ("../conf/settings.php");
require_once 'lib/class/Membership.php';
require_once ("lib/class/AdminUser.php");

$membership = New Membership();

$membership->confirm_Member();

if (isset($_GET['s'])){
    $section = $_GET['s'];
}
else{
    $section = "user";
}

$admin = new AdminUser($dbcon);
?>
<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo sysName; ?> Admin</title>
	<link rel="stylesheet" href="<?php echo uriPath;?>admin/lib/css/reset.css" />
	<link rel="stylesheet" href="<?php echo uriPath;?>admin/lib/css/admin.css" />
	<!--[if lt IE 7]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    </head>
    <body>
	<div id="container">
	    <header>
		<h1><?php echo sysName; ?> Admin</h1>
		<span class="logout"><a href="<?php echo uriPath;?>admin/login.php?status=loggedout">Log Out</a></span>
	    </header>
	    <nav>
		<ul>
		    <li><a href="<?php echo uriPath;?>admin/">Home</a></li>
		    <li><a href="<?php echo uriPath;?>admin/user/">User Info</a></li>
		    <li><a href="<?php echo uriPath;?>admin/education/">Education</a></li>
		    <li><a href="<?php echo uriPath;?>admin/courses/">Relevant Curriculum</a></li>
		    <li><a href="<?php echo uriPath;?>admin/exp/">Professional Experience</a></li>
		    <li><a href="<?php echo uriPath;?>admin/intact/">Interests & Activities</a></li>
		    <li><a href="<?php echo uriPath;?>admin/tech/">Technical Skills</a></li>
		    <li><a href="<?php echo uriPath;?>admin/other/">Other/Misc.</a></li>
		</ul>
	    </nav>
	    <div id="content">
		<form method="POST" name="userInfo" action="">
		    <?php $admin->editSection($section,$dbcon); ?>
		    <input type="submit" value="Submit" name="submit"/>
		    <input type="reset" value="Reset" name="reset"/>
		</form>
	    </div>
	    <footer>
		<p>&copy; <?php echo date('Y'); ?> <a href="http://neomelonas.com/">Neo Melonas</a></p>
	    </footer>

	</div><!--end container-->
    </body>
</html>
