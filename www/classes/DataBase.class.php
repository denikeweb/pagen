<?php
abstract class DataBase {
	public static function connect () {
		global $mysqli;
		if (config::DB) {
			$mysqli = new mysqli (config::DB_SERVER, config::DB_USER, config::DB_PASS, config::DB_NAME);
			$mysqli->query ("SET NAMES 'utf8'");
			$mysqli->query ("SET CHARACTER SET 'utf8'");
		} else {
			#include ('/classes/mysqli.class.php');
			#$mysqli = new mysqli_sham ();
			#WARNING!!!!
		}
	}
	public static function disconnect () {
		global $mysqli;
		if (config::DB) {
			$mysqli->close ();
		}
	}
}
?>