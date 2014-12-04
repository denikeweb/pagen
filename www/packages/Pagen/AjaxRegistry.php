<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */
	namespace Pagen;


	class AjaxRegistry {
		public static $db_used = false;
		public static $path = NULL;
		public static $fullpath = NULL;

		public static function start () {
			ajaxDefault ();
		}
		public static function finish () {
			if (self::$db_used)
				DataBase::disconnect ();
		}
	}

	function ajaxDefault () {
		header ('Content-Type: text/html; charset=utf-8');

		AjaxRegistry::$path = '\\Controllers\\Ajax\\'.strtr(array_shift($_REQUEST), '\\', DIRSEP);
		AjaxRegistry::$fullpath = dirname (dirname (__FILE__)).DIRSEP.AjaxRegistry::$path.'.php';

		if (
			substr_count($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == 0
			//csrf
			or
			$_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'
			//request filt
			or
			AjaxRegistry::$path == 'index'
			//inputs, index.php cann't be controller file
			or
			strpos (AjaxRegistry::$path, '..') > -1
			//inputs, error controller path

		) {exit();}

		if (!is_file(AjaxRegistry::$fullpath)) {
			echo "Warning: controller ".AjaxRegistry::$path." not exists!";
			exit ();
		}
	}

	function loadModule ($module) {
		switch ($module) {
			case 'Config': {
				$lang = \config::LANG;
				if (isset($_COOKIE ['lang'])) {
					if ($_COOKIE ['lang'] == 'uk') {$lang = 'uk';}
					if ($_COOKIE ['lang'] == 'ru') {$lang = 'ru';}
					if ($_COOKIE ['lang'] == 'en') {$lang = 'en';}
				}
				\config::$Lang = $lang;
			}
				break;
			case 'DataBase':{
				AjaxRegistry::$db_used = true;
				DataBase::connect ();
			}
				break;
			default: {
			echo $module.' do not exists';
			exit ();
			}
			break;
		}
	}

	function ajaxSettings ($modules) {
		foreach ($modules as $i) {
			loadModule ($i);
		}
	}