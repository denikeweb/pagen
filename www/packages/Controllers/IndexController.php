<?php
namespace Controllers;

class IndexController extends \eController {
	public function run (){
		$this->printContent ();
	}
	
	private function printContent (){
		$data = array ();
		if (!empty(\Site::$ThisPage ['template'])) {
			$template = \Site::$ThisPage ['template'];
		} else {
			$template = 'index';
		}

		$this->getLocals ($data);
		if (isset(\Site::$ThisPage ['title']))  {$data ['title']   = \Site::$ThisPage ['title'];}
		if (isset(\Site::$ThisPage ['meta_d'])) {$data ['meta_d']  = \Site::$ThisPage ['meta_d'];}
		if (isset(\Site::$ThisPage ['meta_k'])) {$data ['meta_k']  = \Site::$ThisPage ['meta_k'];}
		if (isset(\Site::$ThisPage ['info']))   {$data ['info']    = \Site::$ThisPage ['info'];}
		if (isset(\Site::$Content))             {$data ['content'] = \Site::$Content;}

		$data ['_d'] = new \Data\defaultDesign();
		$files = array(
			'hor_menu' => 'blocks'.DIRSEP.'hor_menu',
			'sign_in_form' => 'blocks'.DIRSEP.'sign_in_form'
		);
		$this->view = \View::factory ($data, $files, $this->word, $template, NULL);
	}
}
?>