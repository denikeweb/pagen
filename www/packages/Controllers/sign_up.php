<?php

	namespace Controllers;
	use \Pagen\eController;
	use \Data\Design;

	class sign_up extends eController {
		public function run (){
			$this->getLocals ($this->data);
			Design::addMenu ($this->data);
			\Data\Pages\SignUp::addTitles($this->data);

			$this->files = Design::getDefaultFilesArray ();
			$this->files ['content'] = 'pages'.DIRSEP.'sign_up';
		}
	}