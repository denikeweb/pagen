<?php
// $start_time = microtime(3); @toDelete
// $start_memory = memory_get_usage(); @toDelete
/**
	*
	* Pagen — high performance HMVC-framework.
	* Framework architecture provides data and logic division.
	* Framework provides using namespaces for work with all classes.
	* Framework uses RandKey for encrypting passwords.
    * Framework uses on of theme for view.
	*
	* @author Denis Dragomiric <den@lux-blog.org>
	* @version Pagen 1.1.6
	* @documentation http://www.lux-blog.org/blog/pagen-framework/pagen-1-1-6
	* @license New BSD
	*
	* @phpVersion PHP 5.4+ {mysqli, mysqlnd, mcrypt}, MySQL 5+
	*
*/


define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('EXT', '.php');
define ('SITE', dirname(__FILE__).DIRSEP);


	include_once 'pagen_config.php';
	#config::checkIP ();
	#config::toLog ();

	\Pagen\Site::checkRequest ();
	\Pagen\DataBase::connect ();
	\Pagen\User::userAuth ();
	\Pagen\Site::setupLanguage ();
	\Pagen\Site::getPage ();
	\Pagen\Site::printPage ();
	\Pagen\DataBase::disconnect ();

/*
	//$iv = mcrypt_create_iv (mcrypt_get_iv_size (MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND);
	$key = "This is a very secret key";
	$text = "Meet me at 11 1111111";
	echo strlen ($text)."\n";

	$iv = \Annex\Files::read ('f2.txt');
	$crypttext = mcrypt_encrypt (MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $iv);
	//echo strlen ($crypttext)."\n";
	\Annex\Files::write ('f1.txt', $crypttext);
	//\Annex\Files::write ('f2.txt', $iv);
	$crypttext = \Annex\Files::read ('f1.txt');
	echo $mytext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_CBC, $iv);

	echo '<br><br><br>';

	$crypttext = mcrypt_encrypt (MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CBC, $iv);
	echo base64_encode($crypttext);
	echo '<br><br><br>';
	echo base64_encode($iv);
	$crypttext2 = base64_decode ('IWsWimrOVt0JkkG+Fw0eVmQt4EbsO3ww3RkXRhdobL9O3HjH0TDyUXQlCbFMGG+AdYIIe4e07Lv3EGgS3kYG7g==');
	$iv2        = base64_decode ('h9FhFMfZCxXUdGac12tbNHgGUuPeCzIyssRjKBz5zU0=');
	echo '<br><br><br>';
	echo $mytext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext2, MCRYPT_MODE_CBC, $iv2);
*/



	$text = '[tag]';
	$masked = \Pagen\PassMask::mask($text);
	echo \Pagen\PassMask::demask($masked);
/*
 *  @toDelete
 *
echo '<br>';
$end_memory = memory_get_usage();
echo $end_memory - $start_memory;
$db_time = $end_time2 - $start_time2;
echo '<br>';
echo '<br>';
$end_time = microtime(3);
$time = $end_time - $start_time;
echo $time, '(', ($time - $db_time),')';*/
?>