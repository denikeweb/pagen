<?php
class Storage {
	private $files;
	private $cache;
	private $keyCache;

	public function __construct ($files, $cache) {
		$this->files = $files;
		$this->cache = $cache;
	}

	public function getFiles () {
		return $this->files;
	}

	public function isCached ($key) {
		$result = isset($cache ['key']);
		if ($result) {
			/**
				*
				*
				* loading cache
				*
				*
			*/
		}
		return $result;
	}

	public function getCache () {
		return $this->keyCache;
	}
}
?>