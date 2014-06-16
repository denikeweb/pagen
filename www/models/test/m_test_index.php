<?php
class m_test_index extends eModel {
	public function returnTitles () {
		$data ['title'] = 'PaGen - iHome';
		$data ['meta_d'] = 'iPaGen';
		$data ['meta_k'] = 'iPaGen';
		$data ['info'] = 'i Denis Dragomirik © 2014';
		$data ['content'] = '<h1 class="h1">iHome page</h1><span class="h1_after"></span><p>PaGen - the best framework.</p>';
		return $data;
	}

	function __construct (){
		$this->setTable(array ('blog'));
		$this->setFields(array ('id', 'title', 'text'));
		$this->setOrder('id', 'DESC');
	}

	public function show () {
		$this->readLast ();
		return true;
	}

	public function add () {
		return true;
	}
}
?>