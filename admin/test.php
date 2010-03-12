<?php require_once ('lib/class/class.twit-clean.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>TweetClean Test</title>
    </head>
    <body>
        <?php
	$tweet = "RT @neomelonas: Don't do #drugs, @neomelonas!";
	$tweet2 = "Working on a #PHP thing to translate #Twenglish into Something Like English. Any suggestions as to what/how I should convert from A to B?";
	$tweet3 = "Interesting find on the iPad keyboard. http://bit.ly/cwrJzq I sure hope it's multitasking.";
	$tweet4 = "@BreakingNews: Canada beats Slovakia in ice hockey, 3-2, setting up U.S.- Canada gold-medal game Sunday at Olympics http://bit.ly/axTB2J";

	$toast = TwitterCleaner::cleanAt($tweet);
	$toast = TwitterCleaner::cleanRT($toast);
	$toast = TwitterCleaner::cleanHash($toast);
	echo $toast;

	echo "<br/>";

	$toast = new TwitterCleaner();
	echo $toast->doTweetClean($tweet);

	echo "<br/>";

	$other = new TwitterCleaner();
	echo $other->doTweetClean($tweet2);
	
	echo "<br/>";

	$crap = new TwitterCleaner();
	echo $crap->expandBitly($tweet3);

	echo "<br/>";
	
	$junk = new TwitterCleaner();
	echo $junk->doTweetClean($tweet4);

	echo "<pre>";
	echo "</pre>";
	?>
    </body>
</html>
