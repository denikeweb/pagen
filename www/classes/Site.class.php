<?php
abstract class Site {
	public static $ThisPage;
	public static $Lang;
	public static $Content;
	public static $urlArray;
	
	public static function setupLanguage (){
		global $word;
		$lang = config::LANG;
		if (isset($_GET ['lang'])) { //if cookie is not showed
			setcookie("lang", $_GET['lang'], time() + 2592000); //set language id
			$url = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
			$pos = strpos($url, "?lang=");
			if ($pos === false) {
				$pos = strpos($url, "&lang=");
			}
			$url = substr($url, 0, $pos);
			//formed uri
			header("Location:$url");
		}
		//standart language is ukrainian
		if (isset($_COOKIE ["lang"])){
			if ($_COOKIE ['lang'] == "uk") {$lang = 'uk';}
			if ($_COOKIE ['lang'] == "ru") {$lang = 'ru';}
			if ($_COOKIE ['lang'] == "en") {$lang = 'en';}
		}
		//choose language if isset cookie
		
		if (config::DB) {
			$query_language = mysql_query("SELECT `$lang`, `id` FROM `".config::PREFIX."titles` WHERE 1");
			$lang_row = mysql_fetch_assoc($query_language);
			do {
				$lang_index = $lang_row ['id'];
				$word [$lang_index] = $lang_row [$lang];
			} while ($lang_row = mysql_fetch_assoc($query_language));
			//create array of language words
		}
		
		self::$Lang = $lang;
	}
	
	public static function getPage (){
		global $word;
		$thisUrl = '/';
		if (isset($_GET ['page'])) {
			if (Validator::urlname($_GET ['page'])) {
				$thisUrl = $_GET ['page'];
			} else {
				$thisUrl = '404';
			}
		}
		$thisUrl = trim($thisUrl, '/\\');
		self::$urlArray = explode('/', $thisUrl);
		$mypage = self::$urlArray [0];
		if (empty($mypage)) {
			$mypage = '/';
		}
		//user-friendly URL

		if (config::DB) {
			$result = mysql_query("SELECT * FROM `".config::PREFIX."pages` WHERE `cpurl`='$mypage'");
			if (mysql_num_rows($result) == 0) {
				$result = mysql_query("SELECT * FROM `".config::PREFIX."pages` WHERE `id`='0'");
			}
			//check page

			self::$ThisPage = mysql_fetch_assoc($result);
			//save data of rhis page in array

			if (self::$ThisPage ['static'] == '1') {
				$title_index = self::$ThisPage ['title'];
				$page_id = self::$ThisPage ['id'];
				// get id for query

				self::$Content = self::getFromDB('content', $page_id);
				//return page content
				
				self::$ThisPage ['meta_k'] = self::getFromDB('meta_k', $page_id);
				self::$ThisPage ['meta_d'] = self::getFromDB('meta_d', $page_id);
				//return meta tags for this page (keywords & description)

				self::$ThisPage['title'] = $word[$title_index];
				// replace title of this page from language array
			}
		}
		print_r(self::$ThisPage);
	}
	
	private static function getFromDB ($table, $page_id){
		$lang_tag = self::$Lang;
		$result = mysql_query("SELECT `$lang_tag` FROM `".config::PREFIX."$table` WHERE `id`='$page_id'");
		if (mysql_num_rows($result) == 0) {
			$result = mysql_query("SELECT `$lang_tag` FROM `".config::PREFIX."$table` WHERE `id`='0'");
		}
		$my_row = mysql_fetch_assoc($result);
		return $my_row [$lang_tag];
	}
	
	public static function printPage () {
		if (self::$ThisPage['static'] == 1) {
			$controller = 'IndexController';
			include ("classes/$controller.php");
			$a = new $controller();
			$a->run();
			//if page is static load default page controller
		} else {
			define ('DIRSEP', DIRECTORY_SEPARATOR);
			$c_pagen_path = dirname(dirname(__FILE__)).DIRSEP.'controllers'.DIRSEP;
			//get path to coltrollers
			$m_pagen_path = dirname(dirname(__FILE__)).DIRSEP.'models'.DIRSEP;
			//get path to models
			$pieces = Site::$urlArray;
			$path = dirname(dirname(__FILE__)).DIRSEP;
			// set site path
			if (empty($pieces [0])) {
				unset ($pieces [0]);
				$controller = 'index';
			}
			//unset empty array element
			foreach ($pieces as $piece) {
				$fullpath = $c_pagen_path.$piece;
				if (is_dir($fullpath)) {
					$c_pagen_path .= $piece.DIRSEP;
					$m_pagen_path .= $piece.DIRSEP;
					array_shift($pieces);
					continue;
				}
				if (is_file($fullpath.'.php')) {
					$controller = $piece;
					array_shift($pieces);
					break;
				}
			}
			//search untill getting file
			if (empty($controller)) {
				#$controller = 'index';
				$file = $path.'404.php';
				include ($file);
				//if controller file not exists, send 404
			} else {
				if (is_array($pieces)) {
					$action = array_shift($pieces);
				} else {
					$action = '';
				}
				if (empty($action) or $action == 'run') {
					$action = 'run';
				} else {
					$action .= 'action_';
				}
				// get action, default method - run ()

				$file = $c_pagen_path.$controller.'.php';
				$m_pagen_path .= $controller.'.php';
				//create full model path
				$args = $pieces;
				include ($file);
				$a = new $controller($m_pagen_path, $args, $path);
				//construct controller
				if (method_exists($a, $action)){
					$a->$action();
				} else {
					$file = $path.'404.php';
					include ($file);
					//if action not exists, send 404
				}
			}
		}
	}
}
?>