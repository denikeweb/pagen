<?php
	/**
	 * demo AJAX-class
	 *
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1.6
	 */

	namespace Controllers\Ajax\blog;
	use \Pagen\eAjaxController;
	use \Pagen\User;
	use \Pagen\eController;

	\Pagen\ajaxSettings (['Config', 'DataBase']);

	class delete extends eAjaxController {
		private $message;
		private $response;

		private $id;

		function request () {
			$this->id   = $_REQUEST ['id'];
		}

		function run () {
			User::init();
			if (User::is_admin ()) {
				$logic = new \Logic\Blog\Index ();
				$this->response = $logic->delete ($this->id);
				$this->message = eController::getWords('alerts') [$logic->message_key];
			} else {
				$this->response = false;
				$this->message = eController::getWords ('alerts') ['access_error'];
			}
		}

		function response () {
			return json_encode([
				'message'  => $this->message,
				'response' => $this->response
			]);
		}
	}
?>
