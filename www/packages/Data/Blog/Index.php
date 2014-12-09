<?php

	namespace Data\Blog;
	use \Pagen\eModel;

	class Index extends eModel {
		public  $page;
		public  $publics_url;
		public  $postPerPage = 5;
		private $title;
		private $tableName;

		public function returnContents () {
			$this->setDefault();
			$this->setTable($this->tableName);
			$this->setOrder('blog_id');
			if (!is_null($this->publics_url)) $this->addCond('blog_url', $this->publics_url);
			$this->setLimits(($this->page - 1) * $this->postPerPage, $this->postPerPage);
			$this->read(is_null($this->publics_url));
			$contents = $this->getData();
			$this->title = $contents ['blog_title'];
			return $contents;
		}

		public function returnTitle () {
			if (is_null($this->publics_url)) {
				$title = 'Записи блога';
			} else
				$title = $this->title;
			return $title;
		}

		public function returnCount () {
			$this->setLimits(NULL, NULL);
			return $this->getCount();
		}

		public function actionAdd ($url, $title, $desc, $text) {
			$this->setTable($this->tableName);
			$this->blog_url = $url;
			$this->blog_title = $title;
			$this->blog_desc = $desc;
			$this->blog_text = $text;
			$result = $this->create();
			return $result;
		}

		public function actionEdit ($url, $title, $desc, $text, $id) {
			$this->setTable($this->tableName);
			$this->blog_url = $url;
			$this->blog_title = $title;
			$this->blog_desc = $desc;
			$this->blog_text = $text;
			$this->addCond('blog_id', $id);
			$result = $this->update();
			return $result;
		}

		public function actionDelete ($id) {
			$this->setTable($this->tableName);
			$result = $this->deleteById($id);
			return $result;
		}
	}