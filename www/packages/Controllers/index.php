<?php

	namespace Controllers;
	use \Pagen\eController;
	use \Data\Design;

	class index extends eController {
		public function run (){
			\Data\Pages\Index::addTitles($this->data);
			$this->files ['content'] = 'pages'.DIRSEP.'static';
		}
	}