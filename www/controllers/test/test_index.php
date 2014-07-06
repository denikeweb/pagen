<?php
class test_index extends eController {

	private $m;

	public function run () {
		$this->loadModel ();

		$this->m = new m_test_index ('blog');
		$this->data = array ();
		$this->data = $this->m->returnTitles ();

		//$this->m->edit ();

		$this->m->add ();

		
		$this->m->setDefault ();
		$this->m->show ();
		//echo $this->m->count ();
		$this->data ['content'] = $this->m->getData ();
		//print_r($this->data);

		$this->view ($this->data);
	}
	public function action_edit () {

	}
}
?>