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
	public function viewCachePath () {return $this->viewCachePath;}
	public function setviewPath ($str) {$this->viewPath = $str; $this->viewCachePath = $str.'cache'.DIRSEP;}

	public function getFiles () {
		return $this->files;
	}

	public function isCached ($key) {
		return$result = isset($this->cache [$key]);
	}

	public function needCaching ($key) {
		$time = $this->getTime($this->files [$key]);
		//echo $this->cache [$key] - $time;
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
		$content = NULL;
		$thisFile = $this->viewCachePath.$this->files [$key].EXT;
		$handle = @fopen($thisFile, 'w');
		if ($handle) {
			fwrite($handle, $content);
			fclose($handle);
		}
		return $content;
	}
}
?>