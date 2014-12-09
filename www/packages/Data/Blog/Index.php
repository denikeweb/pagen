<?php

	namespace Data\Blog;
	use \Pagen\eModel;

	class Index extends eModel {
		public  $page;
		public  $publics_url;
		public  $postPerPage = 5;
		private $title;

		public function returnContents () {
			$this->setDefault();
			$this->setTable('blog');
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
	}