<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 *
	 * @uses \Pagen\DataBase
	 * @uses \Pagen\PageLang
	 * @uses \Pagen\RandKey
	 * @uses \Annex\Validator
	 */

	namespace Controllers\Ajax\auth;
	use \Pagen\DataBase;
	use \Pagen\User;
	use \Pagen\PassMask;
	use \Pagen\eController;
	use \Annex\Validator;
	\Pagen\ajaxSettings (['Config', 'DataBase']);

	class login extends \Pagen\eAjaxController {
		private $message;
		private $response;
		private $email;
		private $pass;

		function request () {
			$this->email = $_REQUEST ['login'];
			$this->pass  = $_REQUEST ['pass'];
		}

		function run () {
			if (\config::CONFIG_ADMIN_ACCESS) {
				$this->not_DB ();
			} else
				$this->use_DB ();
		}

		function response () {
			return json_encode([
				'message'  => $this->message,
				'response' => $this->response
			]);
		}

		private function not_DB () {
			$ver_login = $this->email == \config::ADMIN_EMAIL;
			$ver_pass = (bool) $this->pass == PassMask::demask(\config::PASS);
			if ($ver_login and $ver_pass) {
				User::setUser (0, User::getRights() ['admin']);
				$this->message = eController::getWords ('alerts') ['success_log_in'];
				$this->response = true;
			} else {
				$this->message = eController::getWords ('alerts') ['wrong_login_or_pass'];
				$this->response = false;
			}
		}

		private function use_DB () {
			if (Validator::email ($this->email)) {
				$result = User::getUserInfo($this->email, 'email');
				$ver_pass = (bool) $this->pass == PassMask::demask($result['users_pass']);
				if (isset($result ['users_id']) and $ver_pass) {
					User::setUser ($result ['users_id'], $result ['users_rights']);
					$this->message = eController::getWords ('alerts') ['success_log_in'];
					$this->response = true;
				} else {
					$this->message = eController::getWords ('alerts') ['wrong_login_or_pass'];
					$this->response = false;
				}
			} else {
				$this->message = eController::getWords ('alerts') ['wrong_login_or_pass'];
				$this->response = false;
			}
		}
	}
?>
