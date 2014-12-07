<?php
 $start_time = microtime(3); //@toDelete
 $start_memory = memory_get_usage(); //@toDelete
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
	\Pagen\User::init ();
	\Pagen\Site::facade ();
	\Pagen\DataBase::disconnect ();

/*
 *  @toDelete
 * */
echo '<br>';
$end_memory = memory_get_usage();
echo $end_memory - $start_memory;
$db_time = $end_time2 - $start_time2;
echo '<br>';
echo '<br>';
$end_time = microtime(3);
$time = $end_time - $start_time;
echo $time, '(', ($time - $db_time),')';/**/
?>