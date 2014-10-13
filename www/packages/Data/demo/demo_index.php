<?php
	namespace Data\demo;

class demo_index extends \eModel {
	public function returnTitles () {
		$data ['title'] = 'PaGen - iHome';
		$data ['meta_d'] = 'iPaGen';
		$data ['meta_k'] = 'iPaGen';
		$data ['info'] = 'i Denis Dragomirik © 2014';
		$data ['content'] = '<h1 class="h1">iHome page</h1><span class="h1_after"></span><p>PaGen - the best framework.</p>';
		return $data;
	}

/*	public function show () {
		$this->setDefault ();
		$this->setFields(array ('id', 'title', 'text'));
		//$this->addCond('id', 242);

		// method 1
		# $this->setSQL('((A OR B) AND (C AND (D OR (E OR F))) AND G)');

		// method 2
			$this->addConditions(
				(new \Cdn (
					(new \Cdn(
						(new \Cdn())->setCond('A'),
						(new \Cdn())->setCond('B')
					))->setType (0),
					(new \Cdn(
						(new \Cdn())->setCond('C'),
						(new \Cdn(
							(new \Cdn())->setCond('D'),
							(new \Cdn(
								(new \Cdn())->setCond('E'),
								(new \Cdn())->setCond('F')
							))->setType (0)
						))->setType(0)
					))->setType(1),
					(new \Cdn())->setCond('G')
				))->setType(1)
			);


		$this->setOrder('id', 'DESC');
		$this->debug ();
		$this->lock ();
		$this->read ();
		//$this->readLast ();
		//$this->readById (543);
		//$this->readFirst ();
		//$this->read ();
		return $this->getData ();
	}*/

	public function show () {
		$this->setDefault ();
		$this->setFields(array ('id', 'title', 'text'));
		//$this->addCond('id', 242);

		$px = \config::PREFIX;
		// method 1
		# $this->setSQL('((A OR B) AND (C AND (D OR (E OR F))) AND G)');

		// method 2
			$this->addConditions(
				(new \Cdn (
					(new \Cdn(
						(new \Cdn())->setCond('A'),
						(new \Cdn())->setCond('B')
					))->setType (0),
					(new \Cdn(
						(new \Cdn())->setCond('C'),
						(new \Cdn(
							(new \Cdn())->setCond('D'),
							(new \Cdn(
								(new \Cdn())->setCond('E'),
								(new \Cdn())->setCond("!(`{$px}articles`.`title` LIKE '%today%')")
							))->setType (0)
						))->setType(0)
					))->setType(1),
					(new \Cdn())->setCond('id', 'author_id', 'articles', 'authors')
				))->setType(1)
			);


		$this->setOrder('id', 'DESC');
		$this->debug ();
		$this->lock ();
		$this->read ();
		//$this->readLast ();
		//$this->readById (543);
		//$this->readFirst ();
		//$this->read ();
		return $this->getData ();
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
		//$this->setData(array ('title' => "Add's -> ".mt_rand(0,50), 'text' => "Ha! It's mine text"));
		$this->title = "Add's -> ".mt_rand(0,50);
		$this->text = "Ha! It's mine text";
		return $this->create ();
	}

	public function find () {
		$this->setDefault ();
		$this->setLimits (10);
		$this->setOrder('id', 'DESC');
		$this->search ('title', '40 :342;123fsd weg 34* , r,,() def  ');
		return $this->getData ();
	}
}
?>