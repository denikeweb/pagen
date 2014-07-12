<?php
//phpinfo ();
$start_time = microtime(3);
$start_memory = memory_get_usage();
/**
	* Pagen - is a simple and elegant framework for the site. 
	* It helps simplify the work with project when required 
	* functionality necessary to write from scratch, due to 
	* the generation of pages with userfriendly URL, settings 
	* multilingualism possibility, configured sessions authorization.
	*
	* @author Denis Dragomiric <denikewebpost@yandex.ua>
	* @copyright Denis Dragomiric
	* @license http://www.lux-blog.org/public/pagen/license.txt Pagen 1.0
	*
*/

define ('DIRSEP', DIRECTORY_SEPARATOR);
define ('EXT', '.php');
define ('SITE', dirname(__FILE__).DIRSEP);

include_once 'pagen_config.php';
#config::checkIP ();
#config::toLog ();

include_once SITE.'classes/DataBase.class.php';
include_once SITE.'classes/Validator.class.php';
include_once SITE.'classes/User.class.php';
include_once SITE.'classes/Site.class.php';
include_once SITE.'classes/eController.class.php';
include_once SITE.'classes/Storage.class.php';
include_once SITE.'classes/View.class.php';

//echo memory_get_usage() - $start_memory;

$start_time2 = microtime(2);
DataBase::connect ();
$end_time2 = microtime(2);
User::userAuth ();
Site::setupLanguage ();
Site::getPage ();
Site::printPage ();
DataBase::disconnect ();


echo '<br>';
$end_memory = memory_get_usage();
echo $end_memory - $start_memory;
$db_time = $end_time2 - $start_time2;
echo '<br>';
echo '<br>';
$end_time = microtime(3);
$time = $end_time-$start_time;
echo $time, '(', ($time - $db_time),')';
?>