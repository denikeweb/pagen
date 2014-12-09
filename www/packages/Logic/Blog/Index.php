<?php

	namespace Logic\Blog;

	class Index {
		public $title;
		public $page;
		public $pages_count;

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
	}