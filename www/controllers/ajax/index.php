<?php
	header ('Content-Type: text/html; charset=utf-8');

	define ('DIRSEP', DIRECTORY_SEPARATOR);
	define ('SITE', dirname(dirname(dirname(__FILE__))).DIRSEP);

	$path = strtr(array_shift($_REQUEST), '/', DIRSEP);
	$fullpath = dirname(__FILE__).DIRSEP.$path.'.php';
	$modelPath = strtr($fullpath, DIRSEP.'controllers'.DIRSEP, DIRSEP.'models'.DIRSEP);
	$db_used = false;

	if (
		substr_count($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) == 0
		//csrf
	 		or 
	 	$_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest'
	 	//request filt
	 		or
	 	$path == 'index'
	 	//inputs, index.php cann't be controller file
	 		or
	 	strpos ($path, '..') > -1
	 	//inputs, error controller path
		
		) {exit();}

	if (!is_file($fullpath)) {
		echo "Warning: file $path.php not exists!";
		exit ();
	}

	function __loadModule ($module) {
		switch ($module) {
			case 'Config':
				include_once (SITE.'pagen_config.php');
				break;
			case 'Controller':{
					include_once (SITE.'pagen_config.php');
					include_once (SITE.'classes'.DIRSEP.'eController.class.php');
				}
				break;
			case 'DataBase':{
					include_once (SITE.'pagen_config.php');
					include_once (SITE.'classes'.DIRSEP.'DataBase.class.php');
					$db_used = true;
					DataBase::connect ();
				}
				break;
			case 'PageLang':
				include_once (SITE.'classes'.DIRSEP.'PageLang.class.php');
				break;
			case 'RandKey':
				include_once (SITE.'classes'.DIRSEP.'RandKey.class.php');
				break;
			case 'Validator':
				include_once (SITE.'classes'.DIRSEP.'Validator.class.php');
				break;
			case 'User':
				include_once (SITE.'classes'.DIRSEP.'User.class.php');
				break;
			case 'Files':
				include_once (SITE.'classes'.DIRSEP.'Files.class.php');
				break;
			case 'View':
				include_once (SITE.'classes'.DIRSEP.'View.class.php');
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
	
	include_once ($fullpath);


	$lang = config::LANG;
	if (isset($_COOKIE ['lang'])){
		if ($_COOKIE ['lang'] == 'uk') {$lang = 'uk';}
		if ($_COOKIE ['lang'] == 'ru') {$lang = 'ru';}
		if ($_COOKIE ['lang'] == 'en') {$lang = 'en';}
	}

	config::$Lang = $lang;

	$pieces = explode(DIRSEP, $path);
	$p_count = count ($pieces);
	$controller = $pieces [$p_count - 1];

	$a = new $controller ($modelPath, $_REQUEST);
	$a->run ();

	if ($db_used) {
		DataBase::disconnect ();
	}
?>