<?php

	namespace Controllers;
	use \Pagen\eController;
	use \Data\Design;

	class index extends eController {
		public function run (){
			$this->getLocals ($this->data);
			Design::addMenu ($this->data);
			\Data\Pages\Index::addTitles($this->data);

			$this->files = Design::getDefaultFilesArray ();
			$this->files ['content'] = 'pages'.DIRSEP.'static';

			$this->cache = array(
				'footer' => 30
			);
		}
	}