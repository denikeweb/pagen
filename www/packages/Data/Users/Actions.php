<?php

namespace Data\Users;
use \Pagen\eModel;
use \Pagen\PassMask;

class Actions extends eModel {
	public $email;
	public $pass;
	public $name;
	public $url;

	public function createUser () {
		$this->bufferQuery();

			$this->addBuffer('SET FOREIGN_KEY_CHECKS = 0');
			$this->addBuffer('START TRANSACTION');

				$this->setDefault();
				$this->setTable('users');
				$this->users_url = $this->url;
				$this->create();

				$this->setDefault();
				$this->setTable('users_data');
				$this->users_email = $this->email;
				$this->users_pass  = $this->pass;
				$this->users_name  = $this->name;
				$this->users_rights = 1;
				$this->create();

			$this->addBuffer('COMMIT');

		$this->renderBuffer(false);

		$result = empty($this->mysqli->error);
		return $result;
	}

	public function isEmailUsed () {
		$this->setTable('users_data');
		$this->addCond('users_email', $this->email);
		$result = $this->getCount() != 0;
		return $result;
	}
} 