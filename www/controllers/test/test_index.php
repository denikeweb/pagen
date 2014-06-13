<?php
class test_index extends eController {
	public function run () {
		$this->loadModel ();

		$this->m = new mtest_index ();
		$this->data = array ();
		$this->data = $this->m->returnTitles ();

		$this->data ['content2'] = ($this->m->show());

		$this->view ($this->data);
	}
}
?>