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
		$this->m->show ();
		//echo $this->m->count ();
		$data ['content'] = $this->m->getData ();
		$data = $this->getLocals ($data);
		//print_r($this->data);

		$this->loadModel ('_design');
		$data['_d'] = new _design();
		$files = array(
			'hor_menu' => 'blocks'.DIRSEP.'hor_menu.php',
			'sign_in_form' => 'blocks'.DIRSEP.'sign_in_form.php'/*,
			'lang_settings' => 'functional/set_lang.php' //if (!config::DB)*/
		);
		$this->view = View::factory ($data, $files);
	}
	public function action_edit () {

	}
}
?>