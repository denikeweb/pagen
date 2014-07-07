<?php
class IndexController extends eController {
	public function run (){
		$this->printContent ();
	}
	
	private function printContent (){
		$data = array ();
		if (!empty(Site::$ThisPage ['template'])) {
			$template = Site::$ThisPage ['template'];
		} else {
			$template = 'index';
		}

		$data ['title'] = Site::$ThisPage['title'];
		$data ['meta_d'] = Site::$ThisPage['meta_d'];
		$data ['meta_k'] = Site::$ThisPage['meta_k'];
		$data ['info'] = Site::$ThisPage['info'];
		$data ['content'] = Site::$Content;

		$this->loadModel ('_design');
		$data['_d'] = new _design();
		$files = array(
			'hor_menu' => 'blocks'.DIRSEP.'hor_menu',
			'sign_in_form' => 'blocks'.DIRSEP.'sign_in_form'
		);
		$this->view = View::factory ($data, NULL, $this->word);
	}
}
?>