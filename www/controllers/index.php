<?php
class index extends eController {
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
		
		if (!config::DB){
			$data ['title'] = 'PaGen - Home';
			$data ['meta_d'] = 'PaGen';
			$data ['meta_k'] = 'PaGen';
			$data ['info'] = 'Denis Dragomirik © 2014';
			$data ['content'] = '<h1 class="h1">Home page</h1><span class="h1_after"></span><p>Pagen - the best framework.</p>';
		}

		$this->view ($data, $template);
	}
}
?>