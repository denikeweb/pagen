<?php
class DataBase {
	public static function connect () {
		if (config::DB) {
			mysql_connect (config::DB_SERVER,config::DB_USER,config::DB_PASS);
			mysql_select_db (config::DB_NAME);
			mysql_query ("SET NAMES 'utf8'");
			mysql_query ("SET CHARACTER SET 'utf8'");
		}
	}
	public static function disconnect () {
		if (config::DB) {
			mysql_close ();
		}
	}
}
?>