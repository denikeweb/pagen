<?php
class DataBase{
	public static function connect () {
		if (config::DB) {
			global $mysqli;
			$mysqli = new mysqli (config::DB_SERVER,config::DB_USER,config::DB_PASS,config::DB_NAME);
			$mysqli->query ("SET NAMES 'utf8'");
			$mysqli->query ("SET CHARACTER SET 'utf8'");
		}
	}
	public static function disconnect () {
		if (config::DB) {
			global $mysqli;
			$mysqli->close ();
		}
	}
}
?>