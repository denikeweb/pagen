<?php
	namespace Controllers;
	use \Pagen\Site;
	use \Pagen\eController;
	use \Data\Design;

	class IndexController extends eController {
		public function run (){
			$this->getLocals ($this->data);
			$this->data ['_d'] = new Design ();
			$this->files = Design::getDefaultFilesArray ();

			if (isset(Site::$ThisPage ['title']))  {$this->data ['title']   = Site::$ThisPage ['title'];}
			if (isset(Site::$ThisPage ['meta_d'])) {$this->data ['meta_d']  = Site::$ThisPage ['meta_d'];}
			if (isset(Site::$ThisPage ['meta_k'])) {$this->data ['meta_k']  = Site::$ThisPage ['meta_k'];}
			if (isset(Site::$ThisPage ['info']))   {$this->data ['info']    = Site::$ThisPage ['info'];}
			if (isset(Site::$Content))             {$this->data ['content'] = Site::$Content;}
		}
	}
?>