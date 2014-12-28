<?php

namespace Pagen;

abstract class ParrentController {
	public function __construct () {
		$this->getLocals ($this->data);
		\Data\Design::addMenu ($this->data);
		$this->files = \Data\Design::getDefaultFilesArray ();
		$this->cache = array(
			'footer' => 30
		);
	}
} 