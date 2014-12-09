<?php

	namespace Logic\Blog;

	class Index {
		public $title;
		public $page;
		public $pages_count;
		public $message_key = 'sys_error';

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
			if ($result)
				$this->message_key = 'note_deleted';
			return $result;
		}

		public function add ($url, $title, $desc, $text) {
			$model = new \Data\Blog\Index ();
			if (strlen($url) < 4 or !\Annex\Validator::urlname($url)) {
				$this->message_key = 'blog_wrong_url_format';
				return false;
			}
			if (\Annex\Validator::cyryillic($url)) {
				$this->message_key = 'blog_wrong_url_format';
				return false;
			}
			$result = $model->actionAdd ($url, $title, $desc, $text);
			if ($result)
				$this->message_key = 'note_added';
			return $result;
		}

		public function edit ($url, $title, $desc, $text, $id) {
			$model = new \Data\Blog\Index ();
			$result = $model->actionEdit ($url, $title, $desc, $text, $id);
			if ($result)
				$this->message_key = 'note_edited';
			return $result;
		}
	}