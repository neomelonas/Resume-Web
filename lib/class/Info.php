<?php
/**
 * @package resume-web
 * @subpackage multiuser-resume
 */

/**
 * Info
 * @package resume-web
 * @author neomelonas <neo@neomelonas.com>
 * @version v3.0.5
 * @since v3.0.0
 * @copyright 2009-2010 Neo Melonas
 */
interface Info {
    /**
     * Wherein we set a Factory to create a get method for the rest of the whosises.
     * @param int $offset
     * @param string $thing
     */
    public function getInfo($offset, $thing);
}
?>
