<?php
class test_index extends eController {
	public function run () {
		$this->loadModel ();

		$this->m = new m_test_index ();
		$this->data = array ();
		$this->data = $this->m->returnTitles ();

		//$this->m->show ();
		//$this->data ['content'] = $this->m->getData ();
		//print_r($this->data);

		$this->m->add ();

		$this->view ($this->data);
	}
	public function action_edit () {

	}
}
?>