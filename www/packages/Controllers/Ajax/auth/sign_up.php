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

	class sign_up extends \Pagen\eAjaxController {
		private $message;
		private $response;
		private $email;
		private $pass;
		private $name;
		private $url;

		function request () {
			$this->email = $_REQUEST ['email'];
			$this->pass  = $_REQUEST ['pass'];
			$this->name  = $_REQUEST ['name'];
			$this->url   = $_REQUEST ['url'];
		}

		function run () {
			$logic = new \Logic\Users\Actions();
			$this->response = $logic->signUp ($this->email, $this->pass, $this->name, $this->url);
			$this->message = $logic->message;
		}

		function response () {
			return json_encode([
				'message'  => $this->message,
				'response' => $this->response
			]);
		}
	}
?>
