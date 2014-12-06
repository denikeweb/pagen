<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
	function __autoload($classname) {
		$filename = SITE.'packages'.DIRSEP.strtr($classname, "\\", DIRSEP).'.php';
		include_once($filename);
	}

	abstract class config {
		const LANG = 'uk';
		// default site localisation
		const TITLE = 'MySite';
		// site name

		const PREFIX = 'pagen_';
		// prefix for tables in DataBase
		const DB_SERVER = '127.0.0.1';
		const DB_USER = 'root';
		const DB_PASS = '';
		const DB_NAME = 'awm_05_pagen';

		const ADMIN_EMAIL = 'admin@mysite.com';
		#const PASS = 'w9Kec/J4OmCehhZYpu7iNKnHScVgaWmdAIJiPJF9h6s='; //111111
		const CONFIG_ADMIN_ACCESS = false;
		// if true Pagen use data from config file, else check user in DataBase

		const TEMPLATE = 'pagen';
		// used template
		const CHECK_STATIC_PAGE = true;
		// scan page url in DataBase
		const CHECK_FILES_IN_TEPLATE = true; # don't forget to configure .htaccess
		// check short files URL at template folder
		const GET_USER_DATA = true;
		// get user data from DataBase

		public static $langHash = [
			'uk' => 'uk',
			'ru' => 'ru',
			'en' => 'en'
		];
		// site localisations

		public static $userRights = [
			'guest'  => 0, // important key
			'user'   => 1, // important key
			'v_user' => 2,
			'moder'  => 4,
			'admin'  => 6 // important key
		];
		// user rights

		public static $Lang;
		// current set language, used for ajax

		/*
			public static function checkIP(){
				$host = '|'.$_SERVER['REMOTE_ADDR'].'|';
				if (strpos(\Annex\Files::read ('system/ban.txt'), $host) > -1) {
					exit();
				}
			}

			public static function toLog(){
				Files::writeLog ();
			}
		*/
	}
?>