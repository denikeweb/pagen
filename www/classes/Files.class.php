<?php
abstract class Files {
	/**
	*	Pagen demo-class Files
	*	Pagen v0.8
	*
	*/
	public static function read ($fname){
		$handle = @fopen($fname, 'r');
		if ($handle) {
			$len = filesize($fname);
			$content = @fread($handle, $len);
			@fclose($handle);
		} else {
			$content = false;
		}
		return $content;
	}
	
	public static function write ($fname, $content, $writeMode = 'w'){
		$handle = @fopen($fname, $writeMode);
		$result = false;
		if ($handle) {
			if (fwrite($handle, $content)) {
				$result = true;
			}
			fclose($handle);
		}
		return $result;
	}
	
	public static function writeToEnd ($fname, $content){
		return self::write($fname, $content, 'a');
	}
	
	public static function writeLog ($file = 'system/log.txt'){
		$ip 		=	$_SERVER['REMOTE_ADDR'];
		$host		=	$_SERVER['HTTP_HOST'];
		$script 	=	$_SERVER['SCRIPT_NAME'];
		$method 	=	$_SERVER['REQUEST_METHOD'];
		$user 		=	$_SERVER['HTTP_USER_AGENT'];
		$date 		= 	date('Y.m.d H:i:s');
		$content	=	"$date $ip $method $host $user $script\r\n";
		return self::writeToEnd($file, $content);
	}
	
}
?>