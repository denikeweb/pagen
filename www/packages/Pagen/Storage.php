<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */

	namespace Pagen;

	class Storage {
		private $files;
		private $cache;
		private $keyCache;
		private $viewPath;
		private $viewCachePath;

		public function __construct ($files, $cache) {
			$this->files = $files;
			$this->cache = $cache;
		}

		public function viewPath () {return $this->viewPath;}
		public function viewCachePath () {return $this->viewCachePath;}
		public function setviewPath ($str) {$this->viewPath = $str;}
		public function setviewCachePath ($str) {$this->viewCachePath = $str;}

		public function getFiles () {
			return $this->files;
		}

		public function isCached ($key) {
			return$result = isset($this->cache [$key]);
		}

		public function needCaching ($key) {
			$time = $this->getTime($this->files [$key]);
			return ($this->cache [$key] - $time < 1);
		}

		private function getTime ($file) {
			$time_sec = time ();
			if (is_file($file)) {
				$time_file = filemtime ($file);
			} else {
				$time_file = 0;
			}
			return $time = $time_sec - $time_file;
		}

		public function getCache ($key) {
			$thisFile = $this->viewCachePath.$this->files [$key].EXT;
			$content = NULL;
			$handle = @fopen($thisFile, 'r');
			if ($handle) {
				$len = filesize($thisFile);
				$content = @fread($handle, $len);
				fclose($handle);
			}
			return $content;
		}
	}
?>