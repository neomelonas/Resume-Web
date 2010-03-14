<?php
session_start();
require_once 'lib/class/Membership.php';
$membership = new Membership();
// If the user clicks the "Log Out" link on the index page.
if(isset($_GET['status']) && $_GET['status'] == 'loggedout') {
    $membership->log_User_Out();
}
// Did the user enter a password/username and click submit?
if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])) {
    $response = $membership->validate_User($_POST['username'], $_POST['pwd']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Please Login</title>
    <link rel="stylesheet" type="text/css" href="lib/css/default.css" />
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="lib/js/main.js"></script>
</head>
<body>
<div id="login">
    <form method="post" action="">
    	<h2>Login</h2>
        <p><label for="name">Username: </label><input type="text" name="username" /></p>
        <p><label for="pwd">Password: </label><input type="password" name="pwd" /></p>
        <p><input type="submit" id="submit" value="Login" name="submit" /></p>
    </form>
    <?php if(isset($response)) echo "<h4 class='alert'>" . $response . "</h4>"; ?>
</div><!--end login-->
</body>
</html>
