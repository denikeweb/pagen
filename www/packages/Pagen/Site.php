<?php
	/**
	 * @package Pagen
	 * @version 1.0
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @framework_version Pagen 1.1.6
	 *
	 * @uses \Annex\Validator
	 */
	
	namespace Pagen;
	use \Annex\Validator;

	abstract class Site {
		public static $ThisPage;
		public static $Lang;
		public static $Content;
		public static $urlArray;
		public static $word;
		public static $pageRequest;

		/**
		 * analyzing response and check files used at template
		 */
		public static function checkRequest () {
			self::$pageRequest = '/';

			// if probably called file check existing at template folder
			if (isset ($_GET ['ext']) and \config::CHECK_FILES_IN_TEPLATE) {
				$part = '';
				if (count($_GET ['names'])) $part = '.'.implode('.', $_GET ['names']);
				self::$pageRequest = $_GET ['page'].$part;
				self::printFile ($_GET ['ext']);
			}

			// request validation
			if (isset($_GET ['page']))
				if (Validator::urlname($_GET ['page'])) {
					self::$pageRequest = $_GET ['page'];
				} else
					self::include404();
		}

		/**
		 * redirecting css, js and img files from root to template directory
		 * @param $ext
		 */
		private static function printFile ($ext) {
			switch ($ext) {
				case 'css': $fileType   = 'text/css; charset: UTF-8';                 break;
				case 'js':  $fileType   = 'text/javascript; charset: UTF-8';          break;
				case 'ttf': $fileType   = 'application/x-font-ttf; charset: UTF-8';   break;
				case 'png': $fileType   = 'image/png; charset: UTF-8';                break;
				case 'gif': $fileType   = 'image/gif; charset: UTF-8';                break;
				case 'jpg': $fileType   = 'image/jpg; charset: UTF-8';                break;
				default :   $fileType   = 'text/'.$ext.'; charset: UTF-8';            break;
			}
			$file = dirname (dirname (dirname (__FILE__))).'/templates/'.\config::TEMPLATE.DIRSEP.self::$pageRequest.".$ext";
			$handle = @fopen ($file, 'r');
			if ($handle) {
				$len = filesize ($file);
				$content = @fread ($handle, $len);
				@fclose ($handle);

				// default loading
				header ("Content-type: $fileType");
				header ("Cache-Control: must-revalidate");

				//gzip
				$content = gzencode($content);
				header('content-encoding: gzip');
				header('vary: accept-encoding');
				header('content-length: ' . strlen($content));

				echo $content;
				exit ();
			} else {
				$_GET ['page'] .= '.'.$_GET ['ext'];
			}
		}

		/**
		 * setup site language, if user sent $_GET ['lang']
		 * else setup default site language
		 */
		public static function setupLanguage (){
			$lang = \config::LANG;
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
			if (isset($_COOKIE ['lang']))
				$lang = \config::$langHash [$_COOKIE ['lang']];
			//choose language if isset cookie

			\config::$Lang = self::$Lang = $lang;
		}

		/**
		 * page bootstrapper
		 */
		public static function getPage () {
			//user-friendly URL
			$thisUrl = trim (self::$pageRequest, '/\\');
			self::$urlArray = explode ('/', $thisUrl);
			$mypage = &self::$urlArray [0];
			if (empty($mypage)) $mypage = 'index';

			// check static mode
			if (\config::CHECK_STATIC_PAGE) {
				$dynamic = self::checkStaticPage ($mypage);
			} else
				$dynamic = true;

			// if we have no static page, search and run relevant controller
			if ($dynamic)
				self::printPage ();
		}

		/**
		 * search static page in DataBase
		 *
		 * @param $mypage
		 *
		 * @return bool
		 */
		private static function checkStaticPage ($mypage) {
			$mysqli = &DataBase::$mysqli;
			$px = \config::PREFIX;
			$lang_tag = self::$Lang;

			$query_text = "
					SELECT
						`{$px}pages_titles`.`$lang_tag`,
						`{$px}pages_content`.`$lang_tag`,
						`{$px}pages_meta_k`.`$lang_tag`,
						`{$px}pages_meta_d`.`$lang_tag`
					FROM
						`{$px}pages`

						INNER JOIN `{$px}pages_titles`
							ON  `{$px}pages`.`pages_id`=`{$px}pages_titles`.`pages_id`
						INNER JOIN `{$px}pages_content`
							ON  `{$px}pages`.`pages_id`=`{$px}pages_content`.`pages_id`
						INNER JOIN `{$px}pages_meta_k`
							ON  `{$px}pages`.`pages_id`=`{$px}pages_meta_k`.`pages_id`
						INNER JOIN `{$px}pages_meta_d`
							ON  `{$px}pages`.`pages_id`=`{$px}pages_meta_d`.`pages_id`

					WHERE `pages_url`='$mypage'
				";
			$result = $mysqli->query ($query_text);
			$is_exist = $result->num_rows > 0;
			if ($is_exist) {
				$data = $result->fetch_row ();
				//save data of this page in array

				// get id for query
				self::$Content = $data [1];
				//return page content

				self::$ThisPage ['title'] = $data [0];
				self::$ThisPage ['meta_k'] = $data [2];
				self::$ThisPage ['meta_d'] = $data [3];
			}
			self::defaultController ();
			//if page is static load default page controller
			return !$is_exist;
		}

		/**
		 * sth interesting code, that called need controller
		 */
		private static function printPage () {
			$c_pagen_path = dirname (dirname(__FILE__));
			//get path to controllers
			$pieces = self::$urlArray;
			$controller = '\Controllers';
			// set site path
			if (empty ($pieces [0])) {
				unset ($pieces [0]);
				$controller .= '\index';
			}
			//unset empty array element

			$fullpath = $c_pagen_path;
			foreach ($pieces as $piece) {
				$tmpController = strtr($controller, "\\", DIRSEP);
				if (is_dir ($fullpath.$tmpController)) {
					$controller = $controller.'\\'.$piece;
					$tmpController = strtr($controller, "\\", DIRSEP);
					array_shift ($pieces);
					if (
						is_file  ($fullpath.$tmpController.DIRSEP.'index'.EXT)
						and !is_file ($fullpath.$tmpController.DIRSEP.$pieces [0].EXT)
						and !is_dir   ($fullpath.$tmpController.DIRSEP.$pieces [0])
					) break;
					continue;
				}
				$tmpController = strtr($controller, "\\", DIRSEP);
				if (is_file ($fullpath.$tmpController.EXT)) break;
			}
			//search until getting file

			$tmpController = strtr($controller, "\\", DIRSEP);
			$file = $c_pagen_path.$tmpController.EXT;
			if (empty ($controller) or !is_file ($file)) {
				$tmpFile = $c_pagen_path.$tmpController.DIRSEP.'index'.EXT;
				if (is_file ($tmpFile)) {
					$file = $tmpFile;
				}
			}

			if (empty ($controller)) {
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

				//create full model path
				$args = $pieces;
				$file = strtr($file, "\\", DIRSEP);
				if (!is_file ($file)) {self::include404 ();}
				include ($file);

				$controller = str_replace(['.', '-'], '_', $controller);
				$a = new $controller ($args);
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

		/**
		 * Call controller for static pages
		 *
		 * @param string $controller
		 */
		private static function defaultController ($controller = '\Controllers\IndexController') {
			$a = new $controller(NULL, self::$word);
			self::$word = NULL;
			$a->run();
			self::result ($a);
		}

		/**
		 * return error #404
		 */
		public static function include404 () {
			#header("HTTP/1.x 404 Not Found");
			$file = dirname(dirname(dirname(__FILE__))).DIRSEP.'404'.EXT;
			include ($file);
			exit ();
		}

		/**
		 * echo generated View
		 *
		 * @param eController $a
		 */
		private static function result (eController $a) {
			echo ViewController::getView($a, true);
		}
	}
?>