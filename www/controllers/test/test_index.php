<?php
class test_index extends eController {

	private $m;

	public function run () {
		$this->loadModel ();

		$this->m = new m_test_index ('blog');
		$data = array ();
		$data = $this->m->returnTitles ();

		//$this->m->edit ();

		$this->m->add ();

		$this->m->setDefault ();
		$this->m->count ();
		$this->m->edit ();
		$data ['content'] = $this->m->show ();
		$data = $this->getLocals ($data);
		//print_r($this->data);

		$this->loadModel ('_design');
		$data['_d'] = new _design();
		$files = array(
			'hor_menu' => 'blocks'.DIRSEP.'hor_menu',
			'sign_in_form' => 'blocks'.DIRSEP.'sign_in_form'
		);
		$this->view = View::factory ($data, $files, $this->word);
	}
	public function action_edit () {

	}
}
?>