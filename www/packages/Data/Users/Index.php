<?php

	namespace Data\Users;
	use \Pagen\eModel;

	class Index extends eModel {
		public  $last_id;
		public  $has_more;
		public  $new_last_id;
		private $perOnce;

		public static $title = 'Список пользователей';

		public function returnContents ($perOnce) {
			$this->perOnce = $perOnce;

			$this->setTable('users');
			$this->addJoin('users', 'users_id', 'users_data', 'users_id');

			$this->setOrder('users_id');
			$this->setLimits($this->perOnce);

			if (!is_null($this->last_id))
				$this->addCond('users_id', $this->last_id, 'users', NULL, '<');

			$this->read(true);
			$contents = $this->getData();
			return $contents;
		}

		public function returnCount () {
			$this->setLimits(NULL);
			return $this->getCount();
		}
	}