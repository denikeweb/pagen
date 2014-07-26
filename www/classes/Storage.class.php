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
				$this->setCache($key);
			}
		}
		return $result;
	}

	private function needCaching ($key) {
		$time = $this->getTime($this->files [$key]);
		return true;//($this->cache [$key] - $time < 1);
	}

	private function getTime ($file) {
		$time_sec = time ();
		if (is_file($file)) {
			$time_file = filemtime ($file);
		} else {
			$time_file = $time_sec;
		}
		return $time = $time_sec - $time_file;
	}

	private function setCache ($key) {
		ob_start();
		$tFile = $this->viewPath ().$this->files [$key].EXT;
		if (is_file($tFile)) {
			include $tFile;
			$content = ob_get_clean ();
		} else {
			ob_end_clean();
		}
		$thisFile = $this->viewCachePath.$this->files [$key].EXT;
		$handle = @fopen($thisFile, 'w');
		if ($handle) {
			fwrite($handle, $content);
			fclose($handle);
		}
		echo 1; #11111111111111111111111111111111111111111
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
		return $content;
	}
}
?>