<?php
/*
 * Theme Name: hCard
 * Theme URI: http://projects.neomelonas.com/Resume-Web/
 * Description: 
 * Author: Neo Melonas
 * Author URI: http://neomelonas.com
 * Version: 1
 */
$theName = "";
$theNameClose = "";
if ($resuser->getUserInfo('web') != null){
    $theName .= "<a class=\"url fn\" rel=\"me\" href=\"" . $resuser->getUserInfo('web') . "\">";
    $theNameClose = "</a>";
}
else{
    $theName .= "<span class=\"fn\">";
    $theNameClose = "</span>";
}
$altName = $theName . "<span class=\"given-name\">" . $resuser->getUserInfo('fName') . "</span> <span class=\"family-name\">" . $resuser->getUserInfo('lName') . "</span>" . $theNameClose;

$theName .= $resuser->userFullName('long') . $theNameClose;
$homeLoc = '<span class="type">Home</span>:';
if ($home->getStreet2() != null){
    $loc = $home->getStreet() . " " . $home->getStreet2();
}
else{
    $loc = $home->getStreet();
}
$homeLoc .= '<div class="street-address">'. $loc . '</div><span class="locality">'. $home->getCity() .'</span>,
<abbr class="region" title="'. $home->getStateLong() .'">'. $home->getState() .'</abbr>&nbsp;
<span class="postal-code">'. $home->getZIP() .'</span> <span class="country-name">'.$home->getCountry().'</span>';

$locLoc = '<span class="type">Local</span>:';
if ($local->getStreet2() != null){
    $loc = $local->getStreet() . " " . $local->getStreet2();
}
else{
    $loc = $local->getStreet();
}
$locLoc .= '<div class="street-address">'. $loc . '</div><span class="locality">'. $local->getCity() .'</span>,
<abbr class="region" title="'. $local->getStateLong() .'">'. $local->getState() .'</abbr>&nbsp;
<span class="postal-code">'. $local->getZIP() .'</span> <span class="country-name">'.$local->getCountry().'</span>';

$coCode = "";
$sql = $dbcon->query("SELECT `phoneCode` FROM countrycodes WHERE countryCode LIKE '%".$home->getCountry()."%'");
while($row = $sql->fetch_object()){
    $coCode = $row->phoneCode;
}
preg_replace('/ /','-',$coCode);
$coCode = "+" . $coCode . "-";

?>
<!doctype html>
<html>
    <head profile="http://gmpg.org/xfn/11">
	<title><?php echo $resuser->userFullName('long') . "'s hCard | " . sysName;?></title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<meta name="description" content="Resume" />
	<link rel="profile" href="http://microformats.org/profile/hcard">
	<link type="text/css" rel="stylesheet" href="" />
    </head>
    <body>
	<div class="vcard">
	    <header><?php echo $altName;//$theName; ?></header>
	    <div id="content">
		<div class="adr">
		    <?php echo $homeLoc; ?>
		</div>
		<?php if (!is_null($local->getLocID())) { echo '<div class="adr">' . $locLoc . '</div'; } ?>
		<a class="email" href="mailto:<?php echo $resuser->getUserInfo('email') ?>"><?php echo $resuser->getUserInfo('email'); ?></a>
		<span class="tel"><?php echo $coCode . $resuser->phoneNumber('hcard'); ?></span>
	    </div>
	</div>
	<footer>
	    <p>Page views: <?php echo $resuser->getUserInfo('views'); ?></p>
	</footer>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    </body>
</html>
