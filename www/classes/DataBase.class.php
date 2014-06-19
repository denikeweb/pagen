<?php
class DataBase extends mysqli{
	public static function connect () {
		if (config::DB) {
			mysqli_connect (config::DB_SERVER,config::DB_USER,config::DB_PASS,config::DB_NAME);
			#mysqli_query ("SET NAMES 'utf8'");
			#mysqli_query ("SET CHARACTER SET 'utf8'");
		}
	}
	public static function disconnect () {
		if (config::DB) {
			mysqli_close ();
		}
	}
}
?>