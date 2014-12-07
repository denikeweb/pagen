<?php
	namespace Controllers;
	use \Pagen\Site;
	use \Pagen\eController;
	use \Data\Design;

	class IndexController extends eController {
		public function run (){
			$this->getLocals ($this->data);
			Design::addMenu ($this->data);
			$this->files = Design::getDefaultFilesArray ();
			$this->files ['content'] = 'pages'.DIRSEP.'static';

			if (isset(Site::$ThisPage ['title']))  {$this->data ['title']   = Site::$ThisPage ['title'];}
			if (isset(Site::$ThisPage ['meta_d'])) {$this->data ['meta_d']  = Site::$ThisPage ['meta_d'];}
			if (isset(Site::$ThisPage ['meta_k'])) {$this->data ['meta_k']  = Site::$ThisPage ['meta_k'];}
			if (isset(Site::$Content))             {$this->data ['content'] = Site::$Content;}
		}
	}
?>