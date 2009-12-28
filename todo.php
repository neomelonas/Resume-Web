<?php 
include ('lib/php/classTextile.php');
function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }
    return false;
}
$string = get_include_contents('lib/includes/todo.textile');
$textile = new Textile;
echo $textile->TextileThis($string);
?>