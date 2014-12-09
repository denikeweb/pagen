<?php

	namespace Logic\Users;

	class Index {
		public $last_id;
		public $has_more;
		public $returnPerOnce = 2;

		public function facade ($last_id) {
			$model = new \Data\Users\Index ();
			$model->last_id = $last_id;
			$result = $model->returnContents ($this->returnPerOnce);
			$new_last_id = $result [$this->returnPerOnce - 1] ['users_id'];
			if ($new_last_id > 1) {
				$this->has_more = true;
				$this->last_id = $new_last_id;
			} else
				$this->has_more = false;
			return $result;
		}

		public function getTitle () {
			return \Data\Users\Index::$title;
		}
	}