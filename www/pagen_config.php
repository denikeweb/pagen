<?php
function __autoload($classname) {
	$filename = SITE.'packages'.DIRSEP.$classname.'.php';
	include_once($filename);
}
class config {
	const PREFIX = 'pagen_';
	const LANG = 'uk';
	const TITLE = 'MySite';
	const DB_SERVER = '127.0.0.1';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_NAME = 'awm_001';
	const EMAIL = 'admin@mysite.org';
	const ADMIN = 'admin';
	const PASS = '9GGm6GmcSGaHXiGD8dNuG44R21eRYtiqRhDJ46PBSJCZY'; //111111
	const DB = true;
	const TEMPLATE = 'pagen';
	public static $Lang;
	
	/*public static function checkIP(){
		include_once "classes/Files.class.php";
		$host = '|'.$_SERVER['REMOTE_ADDR'].'|';
		if (strpos(Files::read ('system/ban.txt'), $host) > -1) {
			exit();
		}
	}
	public static function toLog(){
		include_once "classes/Files.class.php";
		Files::writeLog ();
	}*/
}
?>