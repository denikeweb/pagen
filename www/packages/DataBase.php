<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */
abstract class DataBase {
	public static $mysqli;

	public static function connect () {
		self::$mysqli = new mysqli (\config::DB_SERVER, \config::DB_USER, \config::DB_PASS, \config::DB_NAME);
		self::$mysqli->query ("SET NAMES 'utf8'");
		#self::$mysqli->query ("SET CHARACTER SET 'utf8'");
	}
	public static function disconnect () {
		self::$mysqli->close ();
	}
}
?>