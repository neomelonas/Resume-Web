<?php
/**
 * Theme Name: hCard
 * Theme URI: http://projects.neomelonas.com/Resume-Web/
 * Description:
 * @author: Neo Melonas <neo@neomelonas.com>
 * @version 2010-11-01
 */

function theheader($r) {
    echo    '<title>'.$r->resuser->userFullName('long')." | " . sysName .'</title> '.
            '<meta name="author" content="'.$r->resuser->userFullName().'"/> '.
            '<meta name="copyright" content="Copyright 2010 Neo Melonas. All rights reserved." /> '.
            '<meta name="description" content="'. $r->resuser->userFullName() .'\'s r&eacute;sum&eacute; on the Web!" /> '.
            '<meta name="keywords" content="'.$r->resuser->userFullName('link').', '.$r->resuser->userFullName().', r&eacute;sum&eacute;" /> '.
            '<script src="http://static.neomelonas.com/js/modernizr-1.5.min.js" type="text/javascript"></script> '.
            '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js" type="text/javascript"></script>';
}

function afterheader(){}



function thebody($r) {
    $web = $r->resuser->getUserInfo('web');
    $theName = (strlen($web) > 0) ? '<a href="'.$web.'">'.$r->resuser->userFullName('long').'</a>' : $r->resuser->userFullName('long');
    $header = '<header><h1>'.$theName.'</h1></header>';
    $homeloc = '<div id="home">'.$r->home->display().'</div>';
    $locloc =  '<div id="local">'.$r->local->display().'</div>';
    $contact = '<section id="contact">'.$homeloc.$locloc.
    '<div id="moreContact"><span class="phonenumber">'.$r->resuser->phoneNumber().'</span> &bull; <span class="email">'.$r->resuser->getEmail().'</span></div></section>';




    echo $header.$contact;

}
function thefooter($r) {
    
}

?>
