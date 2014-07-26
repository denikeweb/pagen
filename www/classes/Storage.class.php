<?php
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
	public function setviewPath ($str) {$this->viewPath = $str; $this->viewCachePath = $str.'cache'.DIRSEP;}

	public function getFiles () {
		return $this->files;
	}

	public function isCached ($key) {
		$result = isset($this->cache [$key]);
		if ($result) {
			if ($this->needCaching ($key)) {
				$this->setCache();
			}
		}
		return $result;
	}

	private function needCaching ($key) {
		if (is_file($this->files [$key])) {
			$time = $this->getTime($this->files [$key]);
		} else {
			$time = $this->cache [$key];
		}
		return ($this->cache [$key] - $time < 0);
	}

	private function getTime ($file) {
		$time_sec = time ();
		$time_file = filemtime ($file);
		return $time = $time_sec - $time_file;
	}

	private function setCache () {
		/*$thisFile = $this->viewCachePath.$value.EXT;
		if (is_file($thisFile)) {
			include_once $thisFile;
			$var = 'file_'.$key;
			$$var = ob_get_clean();
		} else {
			ob_end_clean();
		}*/
	}

	public function getCache ($key) {
		ob_start();
		$content = NULL;
		$thisFile = $this->viewCachePath.$this->files [$key].EXT;
		if (is_file($thisFile)) {
			include_once $thisFile;
			$content = ob_get_clean();
		} else {
			ob_end_clean();
		}
		return $this->keyCache;
	}
}
?>