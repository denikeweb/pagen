<?php

	namespace Logic\Users;
	use \Pagen\eController;
	use \Annex\Validator;

	class Actions {
		public $message;

		public function signUp ($email, $pass, $name, $url) {
			$alerts = eController::getWords ('alerts');
			$model  = new \Data\Users\Actions ();
			$result = NULL;
			$key    = NULL;

			// data validation
			if (!Validator::cyryillic ($name) or Validator::length ($name) < 2)
				$key = 'wrong_name_format';
			if (!Validator::email($email))
				$key = 'wrong_login_format';
			if (!Validator::login($pass))
				$key = 'wrong_pass_format';
			if (!Validator::urlname($url))
				$key = 'wrong_user_url_format';

			// if data is valid continue
			if (is_null($key)) {
				$model->email = $email;
				// check is entered e-mail signed in system
				if ($model->isEmailUsed()) {
					$key = 'user_exist';
				} else {
					// creare new user
					$model->pass = \Pagen\PassMask::mask ($this->$pass);
					$model->name = $name;
					$model->url = $url;
					$result = $model->createUser ();

					// generate alert key
					if ($result) {
						$key = 'success_sign_up';
					} else
						$key = 'sys_error';
				}
			} else
				$result = false;


			$this->message = $alerts [$key];
			return $result;
		}
	}