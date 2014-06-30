<?php
$start_time = microtime(3);
$start_memory = memory_get_usage();



	header ('Content-Type: text/html; charset=utf-8');

	define ('DIRSEP', DIRECTORY_SEPARATOR);
	define ('SITE', dirname(dirname(dirname(__FILE__))).DIRSEP);

	$path = strtr(array_shift($_REQUEST), '/', DIRSEP);
	$isC = (bool) array_shift($_REQUEST);
	$fullpath = dirname(__FILE__).DIRSEP.$path.'.php';

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

	if ($isC) {
		$eC_path = $dir.'classes'.DIRSEP.'eController.class.php';
		include_once ($eC_path);
	}
	
	include_once ($fullpath);









echo '___';
$end_memory = memory_get_usage();
echo $end_memory - $start_memory;
echo '___';
$end_time = microtime(3);
echo $time = ($end_time-$start_time) * 1000;
?>