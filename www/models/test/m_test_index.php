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

	public function show () {
		$this->setFields(array ('id', 'title', 'text'));
		$this->setOrder('id', 'DESC');
		$this->readLast ();
		//$this->readById (543);
		//$this->readFirst ();
		//$this->addCond('id', 242);
		//$this->read ();
		return $this->getData ();;
	}

	public function count () {
		//$this->setFields(array ('id', 'title', 'text'));
		//$this->setOrder('id', 'DESC');
		return $this->getCount ();
		
	}

	public function edit () {
		$this->addCond('id', 2);
		$this->setData(array ('title' => 'My Article/ for Pagen'));
		return $this->update();
	}

	public function add () {
		$this->setData(array ('title' => "Add's -> ".mt_rand(0,50), 'text' => "Ha! It's mine text"));
		return $this->create ();
	}
}
?>