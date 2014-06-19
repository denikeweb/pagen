<?php
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
   * @copyright Denis Dragomiric, Web-Mount Studio
   * @license http://www.web-mount.com/public/pagen/license.txt Pagen 1.0
   *
*/

$word;

include_once "pagen_config.php";
#config::checkIP ();
#config::toLog ();

include_once "classes/db.class.php";
include_once "classes/Validator.class.php";
include_once "classes/User.class.php";
include_once "classes/Site.class.php";
include_once "classes/eController.class.php";

//echo memory_get_usage() - $start_memory;

$mysqli = new mysqli (config::DB_SERVER,config::DB_USER,config::DB_PASS,config::DB_NAME);
User::userAuth ();
Site::setupLanguage ();
Site::getPage ();
Site::printPage ();
$mysqli->close ();


echo '<br>';
$end_memory = memory_get_usage();
echo $end_memory - $start_memory;
echo '<br>';
$end_time = microtime(3);
echo $time = $end_time-$start_time;
?>