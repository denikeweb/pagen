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
		//print_r($this->data);

		$files = NULL; // array ();
		$this->view = View::factory ($data, $files);
	}
	public function action_edit () {

	}
}
?>