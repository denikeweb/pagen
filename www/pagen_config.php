<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
function __autoload($classname) {
	$filename = SITE.'packages'.DIRSEP.strtr($classname, "\\", DIRSEP).'.php';
	include_once($filename);
}
class config {
	const PREFIX = 'pagen_';
	const LANG = 'uk';
	const TITLE = 'MySite';
	const DB_SERVER = '127.0.0.1';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_NAME = 'awm_05_pagen';
	const EMAIL = 'admin@mysite.org';
	const ADMIN = 'admin';
	const PASS = '9GGm6GmcSGaHXiGD8dNuG44R21eRYtiqRhDJ46PBSJCZY'; //111111
	const DB = true;
	const TEMPLATE = 'pagen';
	const MCRYPT_IV = 'h9FhFMfZCxXUdGac12tbNHgGUuPeCzIyssRjKBz5zU0=';
	// base64 encode iv for mcrypt
	public static $Lang;
	
	/*public static function checkIP(){
		$host = '|'.$_SERVER['REMOTE_ADDR'].'|';
		if (strpos(\Annex\Files::read ('system/ban.txt'), $host) > -1) {
			exit();
		}
	}
	public static function toLog(){
		Files::writeLog ();
	}*/
}
?>