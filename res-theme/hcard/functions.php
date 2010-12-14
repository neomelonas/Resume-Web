<?php
function makeUserName(){
    $theName = "";
    $theNameClose = "";
    if ($resuser->getUserInfo('web') != null){
	$theName .= "<a class=\"url fn n\" href=\"" . $resuser->getUserInfo('web') . "\">";
	$theNameClose = "</a>";
    }
    else{
	$theName .= "<span class=\"fn n\">";
	$theNameClose = "</span>";
    }
    $theName .= $resuser->userFullName('long') . $theNameClose;
    return $theName;
}
function locationAware($type = 0){
    $location = "";
    if ($type == 0){
	$location .= '<span class="type">Home</span>:';

    }
    else {
	if ($local->getStreet2() != null){
	    $loc = $local->getStreet() . " " . $local->getStreet2();
	}
	else{
	    $loc = $local->getStreet();
	}
	$location .= '<span class="type">Local</span>:<div class="street-address">'. $loc . '</div><span class="locality">'. $local->getCity() .'</span>,
    <abbr class="region" title="'. $local->getStateLong() .'">'. $local->getState() .'</abbr>&nbsp;&nbsp;
    <span class="postal-code">'. $local->getZIP() .'</span>';
    }
}
/*
<div class="tel">
    <span class="type">Work</span> +1-650-289-4040
</div>
<div class="tel">
    <span class="type">Fax</span> +1-650-289-4041
</div>
<div>Email:
    <span class="email">info@commerce.net</span>
</div>


*/
?>
