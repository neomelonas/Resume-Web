<?php
/**
 * Copyright (c) 2010 Neo Melonas
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package TwitterCleaner
 */
 /**
  * This class should provide a user with a clean, human readable response based
  * on the input of one Twenglish encrusted Tweet.
  * 
  * @author Neo Melonas <neo@neomelonas.com>
  * @version 1.0
  * @copyright Copyright (c) 2010, Neo Melonas
  * @license http://opensource.org/licenses/mit-license.php The MIT License
  */
class TwitterCleaner {
    /**
     *
     * @var string
     */
    private $bitly = "neomelonas";
    /**
     *
     * @var string
     */
    private $bitlyAPI = "R_3926983e382a0616c0d8a9f91b37a897";

    /**
     * This method will strip off the crunch (#) before a search term and output
     * the HTML link which the hashtag references.
     *
     * @param string $tweet The incoming tweet.
     * @return string $tweetBack The result of the method's actions.
     */
    public function cleanHash($tweet){
	$arr = explode(" ", $tweet);
	$exTweet = new ArrayObject($arr);
	$tweetBack = "";
	$pattern = "/%!()&;,./";
	$iter = $exTweet->getIterator();
	while ($iter->valid()){
	    if (strstr($iter->current(),'#')){
		$quickie = explode("#",$iter->current());
		if (strstr($quickie[1], ":") ||
		    strstr($quickie[1], ";") ||
		    strstr($quickie[1], ".") ||
		    strstr($quickie[1], ",") ||
		    strstr($quickie[1], "!") ||
		    strstr($quickie[1], "@") ||
		    strstr($quickie[1], "#") ||
		    strstr($quickie[1], "$") ||
		    strstr($quickie[1], "%") ||
		    strstr($quickie[1], "&") ||
		    strstr($quickie[1], "(") ||
		    strstr($quickie[1], ")")
		){
		    $quickie[2] = substr($quickie[1], -1);
		    $quickie[1] = substr($quickie[1],0,strlen($quickie[1])-1);
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://search.twitter.com/search?q=%23". $quickie[1] ."\">". $quickie[1] . "</a>" . $quickie[2]);
		}
		else {
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://search.twitter.com/search?q=%23". $quickie[1] ."\">". $quickie[1] . "</a>");
		}
		
	    }
	    $tweetBack = $tweetBack . $iter->current() . " ";
	    $iter->next();
	}
	return $tweetBack;
    }
    /**
     * This method finds all of the @ mentions and replies in the tweet, strips
     * off the @ symbol, and returns the HTML link to the @ed user's Twitter.
     *
     * @param string $tweet The incoming tweet.
     * @return string $tweetBack The result of the method's actions.
     */
    public function cleanAt($tweet){
	$arr = explode(" ", $tweet);
	$exTweet = new ArrayObject($arr);
	$tweetBack = "";
	$iter = $exTweet->getIterator();
	while ($iter->valid()){
	    if (strstr($iter->current(),"@")){
		$quickie = explode("@",$iter->current());
		if (strstr($quickie[1], ":") ||
		    strstr($quickie[1], ";") ||
		    strstr($quickie[1], ".") ||
		    strstr($quickie[1], ",") ||
		    strstr($quickie[1], "!") ||
		    strstr($quickie[1], "#") ||
		    strstr($quickie[1], "$") ||
		    strstr($quickie[1], "%") ||
		    strstr($quickie[1], "&") ||
		    strstr($quickie[1], "(") ||
		    strstr($quickie[1], ")") ||
		    strstr($quickie[1], "-") ||
		    strstr($quickie[1], "+")
		){
		    $quickie[2] = substr($quickie[1], -1);
		    $quickie[1] = substr($quickie[1],0,strlen($quickie[1])-1);
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://twitter.com/". $quickie[1] ."\">". $quickie[1] ."</a>" . $quickie[2]);
		}
		else {
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://twitter.com/". $quickie[1] ."\">". $quickie[1] ."</a>");
		}
	    }
	    $tweetBack = $tweetBack . $iter->current() . " ";
	    $iter->next();
	}
	return $tweetBack;
    }
    /**
     * This method simply replaces the RT found on most retweets with a string.
     * Any string.  Default seems to be RT xxx->  Via xxx:
     * This entire process is to make the tweet more human readable.
     *
     * @param string $tweet The incoming tweet.
     * @return string $tweetBack The result of the method's actions.
     */
    public function cleanRT($tweet){
	$arr = explode(" ", $tweet);
	$exTweet = new ArrayObject($arr);
	$tweetBack = "";
	$iter = $exTweet->getIterator();
	while ($iter->valid()){
	    if (strstr($iter->current(),"RT")){
		$exTweet->offsetSet($iter->key(), "Via ");
	    }
	    $tweetBack = $tweetBack . $iter->current() . " ";
	    $iter->next();
	}
	return $tweetBack;
    }
    /**
     * This method replaces vanilla bit.ly links with the Page Title as the anchor
     * text, and with the actual link address as the Link Title attribute.  This
     * is to allow traffic to still flow through the bit.ly links, to enable
     * more accurate statistics on bit.ly's end.
     *
     * @param string $tweet The incoming tweet.
     * @return string $tweetBack The result of the method's actions.
     */
    public function expandBitly($tweet){
	$arr = explode(" ", $tweet);
	$exTweet = new ArrayObject($arr);
	$tweetBack = "";
	$iter = $exTweet->getIterator();
	while ($iter->valid()){
	    if(strstr($iter->current(), "bit.ly")){
		$hash = substr($iter->current(),14,9);
		$blink = "http://api.bit.ly/expand?version=2.0.1&login=". $this->bitly ."&apiKey=". $this->bitlyAPI ."&hash=".$hash;
		$thisthat = file_get_contents($blink);
		$thing = json_decode($thisthat);
		$errorMessage = $thing->errorMessage;
		if (!$thing->errorCode){
		    $url = $thing->results->$hash->longUrl;
		    if (!$content = @file_get_contents($url)){
			return false;
		    }
		    else if (!preg_match('~<title>(.*?)</title>~si', $content, $title)){
			return false;
		    }
		    $title = $title[1];
		    $link = "<a href=\"". $url ."\">". $title ."</a>";
		    $exTweet->offsetSet($iter->key(),$link);
		}
		else {
		    $url = $thing->errorCode;
		}
	    }
	    $tweetBack = $tweetBack . $iter->current() . " ";
	    $iter->next();
	}
	return $tweetBack;
    }
    /**
     * This method is the coverall for running all of the individual cleaners at
     * the same time.  This makes everything super AWESOME.
     *
     * @param string $tweet The incoming tweet.
     * @return string $tweetBack The result of the method's actions.
     */
    public function doTweetClean($tweet){
	$arr = explode(" ", $tweet);
	$exTweet = new ArrayObject($arr);
	$tweetBack = "";
	$iter = $exTweet->getIterator();
	while ($iter->valid()){
	    if (strstr($iter->current(),"RT")){
		$exTweet->offsetSet($iter->key(), "Tweet from ");
	    }
	    if (strstr($iter->current(),"@")){
		$quickie = explode("@",$iter->current());
		if (strstr($quickie[1], ":") ||
		    strstr($quickie[1], ";") ||
		    strstr($quickie[1], ".") ||
		    strstr($quickie[1], ",") ||
		    strstr($quickie[1], "!") ||
		    strstr($quickie[1], "#") ||
		    strstr($quickie[1], "$") ||
		    strstr($quickie[1], "%") ||
		    strstr($quickie[1], "&") ||
		    strstr($quickie[1], "(") ||
		    strstr($quickie[1], ")") ||
		    strstr($quickie[1], "-") ||
		    strstr($quickie[1], "+")
		){
		    $quickie[2] = substr($quickie[1], -1);
		    $quickie[1] = substr($quickie[1],0,strlen($quickie[1])-1);
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://twitter.com/". $quickie[1] ."\">". $quickie[1] ."</a>" . $quickie[2]);
		}
		else {
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://twitter.com/". $quickie[1] ."\">". $quickie[1] ."</a>");
		}
	    }
	    if (strstr($iter->current(),'#')){
		$quickie = explode("#",$iter->current());
		if (strstr($quickie[1], ":") ||
		    strstr($quickie[1], ";") ||
		    strstr($quickie[1], ".") ||
		    strstr($quickie[1], ",") ||
		    strstr($quickie[1], "!") ||
		    strstr($quickie[1], "@") ||
		    strstr($quickie[1], "#") ||
		    strstr($quickie[1], "$") ||
		    strstr($quickie[1], "%") ||
		    strstr($quickie[1], "&") ||
		    strstr($quickie[1], "(") ||
		    strstr($quickie[1], ")")
		){
		    $quickie[2] = substr($quickie[1], -1);
		    $quickie[1] = substr($quickie[1],0,strlen($quickie[1])-1);
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://search.twitter.com/search?q=%23". $quickie[1] ."\">". $quickie[1] . "</a>" . $quickie[2]);
		}
		else {
		    $exTweet->offsetSet($iter->key(), "<a href=\"http://search.twitter.com/search?q=%23". $quickie[1] ."\">". $quickie[1] . "</a>");
		}

	    }
	    if(strstr($iter->current(), "bit.ly")){
		$hash = substr($iter->current(),14,9);
		$blink = "http://api.bit.ly/expand?version=2.0.1&login=". $this->bitly ."&apiKey=". $this->bitlyAPI ."&hash=".$hash;
		$thisthat = file_get_contents($blink);
		$thing = json_decode($thisthat);
		$errorMessage = $thing->errorMessage;
		if (!$thing->errorCode){
		    $url = $thing->results->$hash->longUrl;
		    if (!$content = @file_get_contents($url)){
			return false;
		    }
		    else if (!preg_match('~<title>(.*?)</title>~si', $content, $title)){
			return false;
		    }
		    $title = $title[1];
		    $link = "<a href=\"". $iter->current() ."\" title=\"". $url ."\">". $title ."</a>";
		    $exTweet->offsetSet($iter->key(),$link);
		}
		else {
		    $url = $thing->errorCode;
		}
	    }
	    $tweetBack = $tweetBack . $iter->current() . " ";
	    $iter->next();
	}
	return $tweetBack;
    }
}
?>
