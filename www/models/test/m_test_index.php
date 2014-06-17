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
		$this->setTable('blog');
	}

	public function show () {
		$this->setFields(array ('id', 'title', 'text'));
		$this->setOrder('id', 'DESC');
		$this->readLast ();
		return true;
	}

	public function edit () {
		$this->addCond('id', 2);
		$this->setData(array ('title' => 'My Article/ for Pagen'));
		$this->update();
		return true;
	}

	public function add () {
		$this->addCond('id', 2);
		$this->setData(array ('title' => 'My Article/ for Pagen'));
		$this->update();
		return true;
	}
}
?>