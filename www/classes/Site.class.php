<?php
abstract class Site {
	public static $ThisPage;
	public static $Lang;
	public static $Content;
	public static $urlArray;
	public static $word;
	
	public static function setupLanguage (){
		global $mysqli;
		$lang = config::LANG;
		if (isset($_GET ['lang'])) { //if cookie is not showed
			setcookie('lang', $_GET['lang'], time() + 2592000); //set language id
			$url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
			$pos = strpos($url, '?lang=');
			if ($pos === false) {
				$pos = strpos($url, '&lang=');
			}
			$url = substr($url, 0, $pos);
			//formed uri
			header('Location:'.$url);
		}
		if (isset($_COOKIE ['lang'])){
			if ($_COOKIE ['lang'] == 'uk') {$lang = 'uk';}
			if ($_COOKIE ['lang'] == 'ru') {$lang = 'ru';}
			if ($_COOKIE ['lang'] == 'en') {$lang = 'en';}
		}
		//choose language if isset cookie
		
		if (config::DB) {
			$query_lang = $mysqli->query('SELECT `'.$lang.'`, `id` FROM `'.config::PREFIX.'titles` WHERE 1');
			$lang_row = $query_lang->fetch_assoc();
			do {
				$lang_index = $lang_row ['id'];
				$word [$lang_index] = $lang_row [$lang];
			} while ($lang_row = $query_lang->fetch_assoc());
			//create array of language words
		}
		
		self::$word = $word;
		self::$Lang = $lang;
		config::$Lang = $lang;
	}
	
	public static function getPage (){
		global $mysqli;
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
			$result = $mysqli->query('SELECT * FROM `'.config::PREFIX.'pages` WHERE `cpurl`=\''.$mypage.'\'');
			$is404 = $result->num_rows == 0;
			if ($is404) {
				$result = $mysqli->query('SELECT * FROM `'.config::PREFIX.'pages` WHERE `id`=\'0\'');
			}
			//check page

			self::$ThisPage = $result->fetch_assoc();
			if ($is404) {
				self::$ThisPage ['static'] = -1;
			}
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

				self::$ThisPage ['title'] = self::$word [$title_index];
				// replace title of this page from language array
			}
		}
	}
	
	private static function getFromDB ($table, $page_id){
		global $mysqli;
		$lang_tag = self::$Lang;
		$result = $mysqli->query('SELECT `'.$lang_tag.'` FROM `'.config::PREFIX.$table.'` WHERE `id`=\''.$page_id.'\'');
		if ($result->num_rows == 0) {
			$result = $mysqli->query('SELECT `'.$lang_tag.'` FROM `'.config::PREFIX.$table.'` WHERE `id`=\'0\'');
		}
		$my_row = $result->fetch_assoc();
		return $my_row [$lang_tag];
	}
	
	public static function printPage () {
		if (self::$ThisPage['static'] == 1) {
			self::defaultController ();
			//if page is static load default page controller
		} else {
			define ('DIRSEP', DIRECTORY_SEPARATOR);
			$c_pagen_path = dirname (dirname(__FILE__)).DIRSEP.'controllers';
			//get path to controllers
			$modelPath = '';
			//get path to models
			$pieces = Site::$urlArray;
			$path = dirname (dirname(__FILE__)).DIRSEP;
			// set site path
			if (empty ($pieces [0])) {
				unset ($pieces [0]);
				$controller = 'index';
			}
			//unset empty array element
			$fullpath = $c_pagen_path;
			foreach ($pieces as $piece) {
				$fullpath .= DIRSEP.$piece;
				if (is_dir ($fullpath)) {
					$c_pagen_path .= DIRSEP.$piece;
					$modelPath .= $piece.DIRSEP;
					array_shift ($pieces);
					continue;
				}
				if (is_file ($fullpath.EXT)) {
					$controller = $piece;
					array_shift ($pieces);
					break;
				}
			}
			//search untill getting file
			if (empty ($controller)) {
				#$controller = 'index';
				self::include404 ();
				//if controller file not exists, send 404
			} else {
				if (is_array ($pieces)) {
					$action = array_shift ($pieces);
				} else {
					$action = '';
				}
				if (empty ($action) or $action == 'run') {
					$_action = 'run';
				} else {
					$_action = 'action_'.$action;
				}
				// get action, default method - run ()

				$file = $c_pagen_path.DIRSEP.$controller.EXT;
				$modelPath .= 'm_'.$controller;
				//create full model path
				$args = $pieces;
				include ($file);
				$a = new $controller ($modelPath, $args, self::$word);
				self::$word = NULL;
				//construct controller
				
				if (method_exists ($a, $_action)){
					$a->$_action ();
					self::result ($a);
				} else {
					if (method_exists ($a, 'run')){
						if (!empty($_action)) {
							array_unshift ($pieces, $action);
							$a->args = $pieces;
						}
						$a->run ();
					self::result ($a);
					} else {
						self::include404 ();
						//if action not exists, send 404
					}
				}
			}
		}
	}
	private static function defaultController ($controller = 'IndexController') {
		include ('classes/'.$controller.EXT);
		$a = new $controller('', NULL, self::$word);
		self::$word = NULL;
		$a->run();
		self::result ($a);
	}
	private static function include404 () {
		header("HTTP/1.x 404 Not Found");
		$file = dirname(dirname(__FILE__)).DIRSEP.'404'.EXT;
		include ($file);
	}
	private static function result (eController $a) {
		echo $a->view;
	}
}
?>