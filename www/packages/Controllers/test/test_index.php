<?php
namespace \Controllers\test;

class test_index extends \eController {

	public function run () {
		$m = new \Data\test_index ('blog');
		$data = $m->returnTitles ();

		//$m->add ();
		//$m->count ();
		//$m->edit ();
		$data ['content'] = $m->show ();
		//$data ['content2'] = $m->find ();
		$this->getLocals ($data);
		//print_r($this->data);

		$data['_d'] = new \Data\defaultDesign();
		$files = array(
			'hor_menu' => 'blocks'.DIRSEP.'hor_menu',
			'sign_in_form' => 'blocks'.DIRSEP.'sign_in_form'
		);
		$cache = array(
			'hor_menu' => 3600
		);
		$this->view = \View::factory ($data, $files, $this->word, 'index', $cache);
	}
}
?>