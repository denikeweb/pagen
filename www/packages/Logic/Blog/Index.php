<?php

	namespace Logic\Blog;

	class Index {
		public $title;
		public $page;
		public $pages_count;
		public $message_key;

		public function facade ($params, &$is_page) {
			$model = new \Data\Blog\Index ();

			$model->page = $params ['page'];
			$model->publics_url = $params [0];
			$result = $model->returnContents ();
			$this->page = $model->page;
			$this->title = $model->returnTitle();

			$is_page = !is_null($model->publics_url);
			if (is_null($model->publics_url))
				$this->pages_count = ceil ($model->returnCount() / $model->postPerPage);

			return $result;
		}

		public function delete ($id) {
			$model = new \Data\Blog\Index ();
			$result = $model->actionDelete ($id);
			return $result;
			// @todo
		}

		public function add ($url, $title, $desc, $text) {
			$model = new \Data\Blog\Index ();
			$result = $model->actionAdd ($url, $title, $desc, $text);
			return $result;
			// @todo
		}

		public function edit ($url, $title, $desc, $text, $id) {
			$model = new \Data\Blog\Index ();
			$result = $model->actionEdit ($url, $title, $desc, $text, $id);
			return $result;
			// @todo
		}
	}