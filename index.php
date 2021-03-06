<?php
/**
 * This is the splash page.
 *
 * @package resume-web
 * @subpackage multiuser-resume
 */
 /**
 * @author Neo Melonas <neo@neomelonas.com>
 * @version v3.0.4
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */

/** Loads the settings, currently for db connections. */
include ('conf/settings.php');
/**
 * Auto-loads all of the necessary class files.
 * @param string $class Guesses the name of the class files.
 */
function __autoload($class) {
    include_once ($uriPath."lib/class/{$class}.php");
}
/** Does some procedural stuff that really does not need done in OOP. */
include ('lib/php/functions.php');
?>
<!doctype html>
<html>
    <head>
        <title><?php echo sysName; ?></title>
	<!-- Using Blueprint-CSS /-->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" /><!-- Favicon /-->
        <link rel="stylesheet" href="lib/css/blueprint/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/plugins/link-icons/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/plugins/buttons/screen.css" type="text/css" media="screen, projection" />
        <link rel="stylesheet" href="lib/css/blueprint/print.css" type="text/css" media="print" />
        <link rel="stylesheet" href="lib/css/blocksANDspecs.css" type="text/css" media="screen, projection" />
        <!--[if IE]>
            <link rel="stylesheet" href="lib/css/blueprint/ie.css" type="text/css" media="screen, projection" />
        <![endif]-->
        <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
        <meta name="description" content="WVU MIS R&eacute;su&eacute; Book" />
    </head>
    <body>
        <div class="container">
	    <div id="admin"><span><a href="admin/">Admin</a></span></div>
            <div id="header">
            <header class="span-24 last prepend-top">
                <h1 class="bottom"><a href="<?php uriPath; ?>">WVU MIS R&eacute;sum&eacute; Book</a></h1>
                <h2 class="alt top"><!--We Really are Quite Incredibly Awesome/-->WE HAVE <?php echo resumeCount($dbcon); ?> RESUMES!</h2>
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
                <div class="span-20 prepend-3" id="firstrow">
                    <section id="mostviewed" class="column list span-5">
                        <h3>Most Viewed R&eacute;sum&eacute;s:</h3>
                        <?php User::mostViewed($uriPath, $dbcon); ?>
		    </section>
                    <section id="featured" class="prepend-2 colborder column list span-5">
                        <h3>Featured R&eacute;sum&eacute;s:</h3>
                        <?php User::featured($uriPath, $dbcon); ?>
                    </section>
                    <section id="recentlyadded" class="prepend-2 column list last">
                        <h3>Recently Added R&eacute;sum&eacute;s:</h3>
                        <?php User::recentAddition($uriPath, $dbcon); ?>
                    </section>
                </div>
                <hr class="space" />
                <div class="span-20 prepend-3" id="secondrow">
                    <section id="recentlyupdated" class="column list span-5">
                        <h3>Recently Updated:</h3>
                        <?php User::recentUpdate($uriPath, $dbcon); ?>
                    </section>
                    <section id="mostsearched" class="prepend-2 column list span-5">
                        <h3>Most Searched Terms:</h3>
                        <ul><?php //mostSearched($uriPath); ?>
                            <li>LIST ONE</li>
                            <li>LIST TWO</li>
                            <li>LIST THREE</li>
                            <li>LIST FOUR</li>
                            <li>LIST FIVE</li>
                        </ul>
                    </section>
                    <section id="browsed" class="prepend-2 column span-5 list last">
                        <h3>Browse...</h3>
                        <ul>
                            <li><a href="<?php uriPath; ?>browse/name/">By Name</a></li>
                            <li><a href="<?php uriPath; ?>browse/year/">By Graduation Year</a></li>
			    <li><a href="<?php uriPath; ?>browse/major/">By Major</a></li>
			    <li><a href="<?php uriPath; ?>browse/minor/">By Minor</a></li>
                        </ul>
                    </section>
                </div>
                <hr class="space" />
            </div>
        </div>
    </body>
</html>
