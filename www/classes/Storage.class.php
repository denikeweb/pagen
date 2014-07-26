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
		return $this->getTime($this->files [$key]) > $this->cache [$key];
	}

	private function getTime ($file) {
		$time_sec = time ();
		//$time_file = filemtime ($file);
		return $time = $time_sec - $time_file;
	}

	private function setCache () {
		$thisFile = $viewPath.$value.EXT;
		if (is_file($thisFile)) {
			include_once $thisFile;
			$var = 'file_'.$key;
			$$var = ob_get_clean();
		} else {
			ob_end_clean();
		}
	}

	public function getCache ($key) {
		ob_start();
		$thisFile = $this->viewPath.$this->files [$key].EXT;
		if (is_file($thisFile)) {
			include_once $thisFile;
			$var = 'file_'.$key;
			$$var = ob_get_clean();
		} else {
			ob_end_clean();
		}
		return $this->keyCache;
	}
}
?>