<?php
	/**
	 * Pagen Controller parent class
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */

	namespace Pagen;

	class ViewController {
		private static $object;
		private $ctrls = [];

		private function __construct () {}
		private function __clone () {}

		public static function facade ($controllerName, $methodName, $params = NULL, $cacheResult = false) {
			if (self::$object == NULL) self::$object = new ViewController ();
			$_this = self::$object;
			$controllerName = '\\Controllers\\'.$controllerName;
			if ($cacheResult && isset ($_this->ctrls [$controllerName] [$methodName])) {
				$ctrl = $_this->ctrls [$controllerName] [$methodName];
			} else {
				$ctrl = new $controllerName ();
				$ctrl->files = [];
				$ctrl->$methodName ($params);
				$_this->ctrls [$controllerName] [$methodName] = $ctrl;
			}

			$ctrl->setTemplate (NULL);

			return self::getView ($ctrl);
		}

		public static function getView (eController $a, $useGzip = false) {
			$content = $a->view ();
			if ($useGzip) {
				$content = gzencode ($content);
				header ('content-encoding: gzip');
				header ('vary: accept-encoding');
				header ('content-length: '.strlen ($content));
			}
			return $content;
		}
	}