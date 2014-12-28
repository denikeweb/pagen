<?php

	namespace Controllers;
	use \Pagen\eController;
	use \Data\Design;

	class test extends eController {
		public function run () {
			//$this->files = Design::getDefaultFilesArray ();
			//$this->files = ['header' => 'blocks'.DIRSEP.'header'];
		}
	}



	/*public function run (){
		$this->getLocals ($this->data);
		Design::addMenu ($this->data);
		\Data\Pages\Index::addTitles($this->data);

		$this->files = Design::getDefaultFilesArray ();
		$this->files ['content'] = 'pages'.DIRSEP.'static';

		$this->cache = array(
			'footer' => 30
		);
	}*/