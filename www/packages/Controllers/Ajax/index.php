<?php
	/**
	 *
	 * @ajaxController
	 * @pagen1.1
	 * @author Denis Dragomiric
	 *
	 */
	header ('Content-Type: text/html; charset=utf-8');

	define ('DIRSEP', DIRECTORY_SEPARATOR);
	define ('SITE', dirname(dirname(dirname(dirname(__FILE__)))).DIRSEP);

	class PagenAjaxRegistry {
		public static $db_used = false;
		public static $path = NULL;
		public static $fullpath = NULL;
	}

	PagenAjaxRegistry::$path = strtr(array_shift($_REQUEST), '/', DIRSEP);
	PagenAjaxRegistry::$fullpath = dirname(__FILE__).DIRSEP.PagenAjaxRegistry::$path.'.php';

	if (
		substr_count($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == 0
		//csrf
	 		or 
	 	$_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'
	 	//request filt
	 		or
		PagenAjaxRegistry::$path == 'index'
	 	//inputs, index.php cann't be controller file
	 		or
	 	strpos (PagenAjaxRegistry::$path, '..') > -1
	 	//inputs, error controller path
		
		) {exit();}

	if (!is_file(PagenAjaxRegistry::$fullpath)) {
		echo "Warning: file {${PagenAjaxRegistry::$path}}.php not exists!";
		exit ();
	}

	function __loadModule ($module) {
		switch ($module) {
			case 'Config':
				include_once (SITE.'pagen_config.php');
				break;
			case 'DataBase':{
					include_once (SITE.'pagen_config.php');
					include_once (SITE.'packages'.DIRSEP.'DataBase.php');
					PagenAjaxRegistry::$db_used = true;
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

	function __settings ($modules) {
		foreach ($modules as $i) {
			__loadModule ($i);
		}
	}
	
	include_once (PagenAjaxRegistry::$fullpath);


	$lang = config::LANG;
	if (isset($_COOKIE ['lang'])){
		if ($_COOKIE ['lang'] == 'uk') {$lang = 'uk';}
		if ($_COOKIE ['lang'] == 'ru') {$lang = 'ru';}
		if ($_COOKIE ['lang'] == 'en') {$lang = 'en';}
	}

	config::$Lang = $lang;

	$pieces = explode(DIRSEP, PagenAjaxRegistry::$path);
	$p_count = count ($pieces);
	$controller = $pieces [$p_count - 1];

	$a = new $controller ($_REQUEST);
	$a->run ();

	if (PagenAjaxRegistry::$db_used) {
		DataBase::disconnect ();
	}
?>